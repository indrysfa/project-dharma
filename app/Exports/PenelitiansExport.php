<?php

namespace App\Exports;

use App\Models\Penelitian;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenelitiansExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Penelitian::all();
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
