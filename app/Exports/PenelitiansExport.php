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
        // return Penelitian::all();
        return Penelitian::join('dosens', 'penelitians.dosen_id', '=', 'dosens.id')
            ->join('statuses', 'penelitians.status_id', '=', 'statuses.id')
            ->join('periodes', 'penelitians.periode_id', '=', 'periodes.id')
            ->select('penelitians.created_at', 'dosens.name_dsn', 'judul_penelitian', 'statuses.name', 'jumlah_anggota', 'periodes.tahun')
            ->orderBy('penelitians.created_at', 'desc')
            ->get();
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
