<?php

namespace App\Exports;

use App\Models\Pengembangan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengembangansExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pengembangan::join('dosens', 'pengembangans.dosen_id', '=', 'dosens.id')
            ->join('jenis_pengdiris', 'pengembangans.jenis_pengdiri_id', '=', 'jenis_pengdiris.id')
            ->join('periodes', 'pengembangans.periode_id', '=', 'periodes.id')
            ->select('pengembangans.created_at', 'dosens.name_dsn', 'jenis_pengdiris.name_jp', 'judul_pengdiri', 'lokasi_pengdiri', 'periodes.tahun', 'periodes.semester')
            ->orderBy('pengembangans.created_at', 'desc')
            ->get();
    }
}
