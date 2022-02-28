<?php

namespace App\Imports;

use App\Models\Campus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CampusImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Campus([
            //
            'name'  => $row['name'],
            'link' => $row['link'],
            // 'address' => $row['address'],
        ]);
    }
}
