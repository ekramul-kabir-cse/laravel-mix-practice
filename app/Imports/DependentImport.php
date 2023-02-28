<?php

namespace App\Imports;

use App\Models\Dependent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
class DependentImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $dob = Carbon::createFromFormat('d/m/Y', $row['dob'])->format('Y-m-d');
        // Convert '04/12/2023' to '2023-12-04'
        return new Dependent([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'    => $row['phone'],
            'image'    => $row['image'],
            'address'  => $row['address'],
            'dob' => Carbon::createFromFormat('d/m/Y', $row['dob'])->format('Y-m-d'),
            
        ]);
    }
}
