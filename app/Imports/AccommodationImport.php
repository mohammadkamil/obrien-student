<?php

namespace App\Imports;

use App\Models\Accommodation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AccommodationImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Accommodation([
            'name'  => $row['name'],
            'link' => $row['link'],
            // 'address' => $row['address'],
        ]);
    }
}
