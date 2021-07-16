<?php

namespace App\Http\Controllers;

use App\Models\Pengembangan;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembanganController extends Controller
{
    public function index()
    {
        // $data = DB::table('pengembangans')
        //     ->join('periodes', 'periodes.id', '=', 'pengembangans.periode_id')
        //     ->join('jenis_pengdiris', 'jenis_pengdiris.id', '=', 'pengembangans.jenis_pengdiri_id')
        //     ->get();
        //     dd($data);
        $data = Pengembangan::all();
        return view('pengembangan.index', compact('data'));
    }

    public function create()
    {
        $periode        = DB::table('periodes')->get();
        $jenis_pengdiri = DB::table('jenis_pengdiris')->get();
        return view('pengembangan.add', compact('periode', 'jenis_pengdiri'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_pengdiri'    => 'required',
            'lokasi_pengdiri'   => 'required',
        ]);

        $data = Pengembangan::create([
            'periode_id'        => $request->periode_id,
            'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
            'judul_pengdiri'    => $request->judul_pengdiri,
            'lokasi_pengdiri'   => $request->lokasi_pengdiri,
        ]);

        if ($data) {
            return redirect()->route('pengembangan.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengembangan $pengembangan)
    {
        $periode        = DB::table('periodes')->get();
        $jenis_pengdiri = DB::table('jenis_pengdiris')->get();
        return view('pengembangan.edit', compact('pengembangan', 'periode', 'jenis_pengdiri'));
    }

    public function update(Request $request, Pengembangan $pengembangan)
    {
        $pengembangan = Pengembangan::findOrFail($pengembangan->id);

        $pengembangan->update([
            'periode_id'        => $request->periode_id,
            'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
            'judul_pengdiri'    => $request->judul_pengdiri,
            'lokasi_pengdiri'   => $request->lokasi_pengdiri,
        ]);

        if ($pengembangan) {
            return redirect()->route('pengembangan.index')->with('success', 'Judul pengembangan ' . $pengembangan["judul_pengdiri"] . ' Updated successfully');
        }
    }

    public function destroy(Pengembangan $pengembangan)
    {
        $pengembangan->find($pengembangan->id)->all();

        $pengembangan->delete();

        if ($pengembangan) {
            return redirect()->route('pengembangan.index')->with('success', 'Judul pengembangan ' . $pengembangan["judul_pengdiri"] . ' deleted successfully');
        }
    }
}
