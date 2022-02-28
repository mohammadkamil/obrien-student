<?php

namespace App\Exports;

use App\Models\Intake;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class IntakeExport implements FromCollection, WithHeadings, WithMapping
{
    public $academic_id, $keyword,$loop;

    public function __construct($academic_id, $keyword)
    {
        $this->academic_id = $academic_id;
        $this->keyword = $keyword;
        $this->loop=0;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Student::query();
        $keyWord = "%".$this->keyword."%";
        $query->when($this->academic_id != null || $this->academic_id != "", function ($q) use ($keyWord) {
            return $q->with('studentprofile', 'programme', 'institution', 'campus', 'academicterm')->latest()->where('academic_term_id', '=', $this->selected_academic_term)
                ->Where(function ($query) use ($keyWord) {
                    $query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord . '%');
                    })
                        ->orwhereHas('programme', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        })
                        ->orwhereHas('institution', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        })
                        ->orwhereHas('campus', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        });
                });
        });
        $query->when($this->academic_id == null || $this->academic_id == "", function ($q) use ($keyWord) {
            return $q->with('studentprofile', 'programme', 'institution', 'campus', 'academicterm')->latest()
                ->Where(function ($query) use ($keyWord) {
                    $query->orwhereHas('studentprofile', function ($query) use ($keyWord) {
                        $query->where('name', 'like', $keyWord . '%');
                    })
                        ->orwhereHas('programme', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        })
                        ->orwhereHas('institution', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        })
                        ->orwhereHas('campus', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord . '%');
                        });
                });
        });
        return $query->get();
    }
    public function headings(): array
    {
        return [
            // 'id',
            ' ',
            'name',
            'program',
            'year',
            'institution',
            'campus',
            'student no',
            'fees',
            'status'
        ];
    }
    // public function columnFormats(): array
    // {
    //     return [
    //         'C' => NumberFormat::FORMAT_NUMBER ,
    //         'D' => NumberFormat::FORMAT_NUMBER,
    //     ];
    // }
    public function map($row): array
    {
        $this->loop++;
        $status = "";
        if ($row->status == 1) {
            $status = "Application in Process";
        } elseif ($row->status == 2) {
            $status = "Offer Letter Receive ";
        } elseif ($row->status == 3) {
            $status = "Accept Offer";
        } elseif ($row->status == 4) {
            $status = "Reject Offer";
        } elseif ($row->status == 5) {
            $status = "Completed";
        }
        $program = "";
        if (isset($row->programme->name)) {
            $program = $row->programme->name;
        }
        $institution = "";
        if (isset($row->institution->name)) {
            $institution = $row->institution->name;
        }
        $campus = "";
        if (isset($row->campus->name)) {
            $campus = $row->campus->name;
        }
        $student_no = "";
        $fees = "";
        $name = "";
        if (isset($row->studentprofile->student_no)) {
            $student_no = $row->studentprofile->student_no;
            $fees = $row->studentprofile->fees;
            $name = $row->studentprofile->name;
        }
        return [
            $this->loop,
            $name,
            $program,
            $row->year,
            $institution,
            $campus,
            $student_no,
            $fees,
            $status
        ];
    }
}
