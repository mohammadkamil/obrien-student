<?php

namespace App\Imports;

use App\Models\Programme;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProgramImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $mara_status=0;
        if($row['marastatus']==0||$row['marastatus']=="no"||$row['marastatus']=="No"||$row['marastatus']=="NO"){
            $mara_status=0;
        }else if($row['marastatus']==1||$row['marastatus']=="yes"||$row['marastatus']=="Yes"||$row['marastatus']=="YES"){
            $mara_status=1;
        }
        return new Programme([

                'name'  => $row['name'],
                'code' => $row['code'],
                'mara_status' => $mara_status,
                // 'address' => $row['address'],
        ]);
    }
}
