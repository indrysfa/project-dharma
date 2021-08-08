<?php

namespace App\Exports;

use App\Models\Pengabdian;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengabdiansExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengabdian::join('dosens', 'pengabdians.dosen_id', '=', 'dosens.id')
            ->join('periodes', 'pengabdians.periode_id', '=', 'periodes.id')
            ->select('dosens.name_dsn', 'judul_pkm', 'nama_komunitas', 'lokasi_pkm', 'periodes.tahun', 'periodes.semester')
            ->orderBy('pengabdians.created_at', 'desc')
            ->get();
    }
}
