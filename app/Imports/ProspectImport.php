<?php

namespace App\Imports;

use App\Models\Academicterm;
use App\Models\Application;
use App\Models\Programme;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProspectImport implements ToModel, WithHeadingRow
{
    public $academic, $academic_id, $program;
    public function __construct($academic_id)
    {
        $this->academic_id = $academic_id;
        $this->academic = Academicterm::all()->pluck("id", "name");
        $this->program = Programme::all()->pluck("id", "name");
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Application([
            //
            'name'  => $row['studentname'],
            'tel' => $row['studentno'],
            'parent_name'  => $row['parentname'],
            'parent_tel' => $row['parenttel'],
            'program'  => $this->program[$row['program']],
            'considering_intake' =>  $this->academic[$row['consideringintake']],
            'current_status'  => $row['currentstatus'],
            'get_know_obrien' => $row['source'],
            'notes'  => $row['notes'],
            'status'=>2
        ]);
    }
}
