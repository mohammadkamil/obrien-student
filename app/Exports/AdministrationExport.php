<?php

namespace App\Exports;

use App\Models\Administration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AdministrationExport implements FromCollection, WithHeadings, WithMapping,WithColumnFormatting
{
    public $academic_id, $keyword, $loop;

    public function __construct($academic_id, $keyword)
    {
        $this->academic_id = $academic_id;
        $this->keyword = $keyword;
        $this->loop = 0;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Administration::all();
        $query = Administration::query();
        $keyWord = "%" . $this->keyword . "%";
        $query->when($this->academic_id != null || $this->academic_id != "", function ($q) use ($keyWord) {
            return $q->with('student.studentprofile')
                ->Where(function ($query) use ($keyWord) {
                    $query->whereHas('student', function ($query) use ($keyWord) {
                        $query->where('academic_term_id', '=', $this->academic_id);
                    })->Where(function ($query) use ($keyWord) {
                        $query->orwhereHas('student.studentprofile', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord);
                        })->orWhere('vaccine_type', 'LIKE', $keyWord)
                            ->orWhere('second_dose', 'LIKE', $keyWord)
                            ->orWhere('address', 'LIKE', $keyWord)
                            ->orWhere('flight_routing', 'LIKE', $keyWord)
                            ->orWhere('date_arrival', 'LIKE', $keyWord);
                    });
                });
        });
        $query->when($this->academic_id == null || $this->academic_id == "", function ($q) use ($keyWord) {
            return $q->with('student.studentprofile')
                ->Where(function ($query) use ($keyWord) {
                    $query->Where(function ($query) use ($keyWord) {
                        $query->orwhereHas('student.studentprofile', function ($query) use ($keyWord) {
                            $query->where('name', 'like', $keyWord);
                        })->orWhere('vaccine_type', 'LIKE', $keyWord)
                            ->orWhere('second_dose', 'LIKE', $keyWord)
                            ->orWhere('address', 'LIKE', $keyWord)
                            ->orWhere('flight_routing', 'LIKE', $keyWord)
                            ->orWhere('date_arrival', 'LIKE', $keyWord);
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
            'Pasport Number',
            'IC Number',
            'Contact Number',
            'Email',
            'vaccine type',
            'second dose',
            'address',
            'flight routing',
            'date arrival',
            'Parent name',
            'Contact number',
            'address',
            'email',

        ];
    }
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER ,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    public function map($row): array
    {
        $this->loop++;

        return [
            $this->loop,
            $row->student->studentprofile->name,
            $row->student->studentprofile->passport_no,
            $row->student->studentprofile->ic_no,
            $row->student->studentprofile->tel,
            $row->student->studentprofile->email,
            $row->vaccine_type,
            $row->second_dose,
            $row->address,
            $row->flight_routing,
            $row->date_arrival,
            $row->student->parentprofile->name,
            $row->student->parentprofile->tel,
            $row->student->parentprofile->address,
            $row->student->parentprofile->email,

        ];
    }
}
