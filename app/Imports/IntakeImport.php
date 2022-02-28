<?php

namespace App\Imports;

use App\Models\Academicterm;
use App\Models\Administration;
use App\Models\Alumni;
use App\Models\Campus;
use App\Models\Institution;
use App\Models\Programme;
use App\Models\Student;
use App\Models\StudentLogin;
use App\Models\Studentprofile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IntakeImport implements ToModel, WithHeadingRow
{
    public $academic, $academic_id, $program, $campus, $institution;

    public function __construct($academic_id)
    {
        $this->academic_id = $academic_id;
        $this->academic = Academicterm::all()->pluck("id", "name");
        $this->program = Programme::all()->pluck("id", "name");
        $this->campus = Campus::all()->pluck("id", "name");
        $this->institution = Institution::all()->pluck("id", "name");
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $statuss = [
            "Application in Process" => 1,
            "Offer Letter Received" => 2,
            "Accept Offer" => 3,
            "Reject Offer" => 4,
            "Completed" => 5,
        ];
        $programe = "";
        $campus = "";
        $institution = "";

        if (array_key_exists($row['program'], $this->program->toArray())) {
            $programe = $this->program[$row['program']];
        } else {
            $program = Programme::create(["name" => $row['program']]);
            $programe = $program->id;
        }
        if (array_key_exists($row['campus'], $this->campus->toArray())) {
            $campus = $this->campus[$row['campus']];
        } else {
            $query = Campus::create(["name" => $row['campus']]);
            $campus = $query->id;
        }
        if (array_key_exists($row['institution'], $this->institution->toArray())) {
            $institution = $this->institution[$row['institution']];
        } else {
            $query = Institution::create(["name" => $row['institution']]);
            $institution = $query->id;
        }
        $student_profile=Studentprofile::create([
            "name"=>$row['name']
        ]);
        $student= Student::create([
            'student_profile_id'  => $student_profile->id,
            'programme_id'  => $programe,
            'year' => $row['year'],
            'academic_term_id'  => $this->academic_id,
            'institution_id'  => $institution,
            'campus_id' =>  $campus,
            'student_no'  => $row['studentno'],
            'fees' => $row['fees'],
            'status'  => $statuss[$row['status']],
        ]);
        if($statuss[$row['status']]==3){
            Administration::create(["student_id"=>$student->id]);
        }elseif($statuss[$row['status']]==5){
            Administration::create(["student_id"=>$student->id]);
           $alumnis= Alumni::create(["student_id"=>$student->id]);

            StudentLogin::create([
                'alumnis_id' => $alumnis->id,
                'email' => $row['email'],
                'password' => bcrypt($row['ic']),

            ]);
        }
        return $student;
    }
}
