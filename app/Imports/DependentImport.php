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
        $date = $row['dob'];
        $dateObj = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date);
        $dateFormatted = $dateObj->format('Y-m-d');
        // return new Dependent([
        //     'name'         => $row['name'],
        //     'email'        => $row['email'],
        //     'phone'        => $row['phone'],
        //     'image'        => $row['image'],
        //     'address'      => $row['address'],
        //     'dob'          => $dateFormatted,
        // ]);
        Dependent::updateOrInsert([
            'email' => $row['email'] //update where get same email
        ], [
            'name'    => $row['name'],
            'phone'   => $row['phone'],
            'image'   => $row['image'],
            'address' => $row['address'],
            'dob'     => $dateFormatted,
        ]);  
    }
}
