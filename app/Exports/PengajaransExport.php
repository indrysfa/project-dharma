<?php

namespace App\Exports;

use App\Models\Pengajaran;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengajaransExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Penelitian::all();
        return Pengajaran::join('dosens', 'pengajarans.dosen_id', '=', 'dosens.id')
            ->join('statuses', 'pengajarans.status_id', '=', 'statuses.id')
            ->join('periodes', 'pengajarans.periode_id', '=', 'periodes.id')
            ->select('dosens.name_dsn', 'kode_mk', 'nama_mk', 'kelas', 'sks')
            ->orderBy('pengajarans.created_at', 'desc')
            ->get();
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
