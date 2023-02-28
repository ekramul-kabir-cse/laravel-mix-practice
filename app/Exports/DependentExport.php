<?php

namespace App\Exports;

use App\Models\Dependent;
use Maatwebsite\Excel\Concerns\FromCollection;

class DependentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dependent::select('name','email','phone','image','address')->get();
    }
}
