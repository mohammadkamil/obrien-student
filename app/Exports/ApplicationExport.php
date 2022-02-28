<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ApplicationExport implements FromCollection, WithHeadings,WithColumnFormatting,WithMapping
{
    public $academic_id,$keyword,$loop;
    public function __construct($keyword) {
        // $this->academic_id = $academic_id;
        $this->keyword = $keyword;
        $this->loop=0;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Application::all();
        $keyWord = '%' . $this->keyword . '%';

        return Application::latest()->Where(function($query) use ($keyWord){
            $query->orWhere('name', 'LIKE', $keyWord)
            ->orWhere('tel', 'LIKE', $keyWord)
            ->orWhere('ic_no', 'LIKE',$keyWord)
            ->orWhere('email', 'LIKE', $keyWord)
            ->orWhere('gander', 'LIKE',$keyWord)
            ->orWhere('current_status', 'LIKE', $keyWord)
            ->orWhere('current_institution', 'LIKE', $keyWord)
            ->orWhere('get_know_obrien', 'LIKE', $keyWord)
            ->orWhere('funding', 'LIKE',$keyWord);
        })->get();
    }
    public function headings(): array
    {
        return [
            // 'id',
            ' ',

            'name',
            'tel',
            'ic_no',
            'email',
            'gander',
            'current_status',
            'current_institution',
            'get_know_obrien',
            'funding',
            'notes',
            'programme_id',
            'academic_term_id',
            'status','year',
            'parent_name',
            'parent_tel',
            'considering_intake',
            'program',
        ];
    } public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER ,
            'D' => NumberFormat::FORMAT_NUMBER,
        ];
    }public function map($row): array
    {
        $this->loop++;
        $status="";
        if($row->status==0){
            $status="new";
        }elseif($row->status==1){
            $status="Proceed with application";

        }elseif($row->status==1){
            $status="Cancel";

        }
        return [
            $this->loop,
            $row->name,
            $row->tel,
            $row->ic_no,
            $row->email,
            $row->gander,
            $row->current_status,
            $row->current_institution,
            $row->get_know_obrien,
            $row->funding,
            $row->notes,
            $row->programme_id,
            $row->academic_term_id,
            $status,
            $row->year,
            $row->parent_name,
            $row->parent_tel,
            $row->considering_intake,
            $row->program,
        ];
    }
}
