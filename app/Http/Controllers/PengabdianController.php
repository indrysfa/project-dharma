<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengabdianController extends Controller
{
    public function index()
    {
        $data    = Pengabdian::all();
        $periode = DB::table('periodes')->first();
        return view('pengabdian.index', compact('data', 'periode'));
    }

    public function create()
    {
        $periode = DB::table('periodes')->get();
        return view('pengabdian.add', compact('periode'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_pkm'         => 'required',
            'nama_komunitas'    => 'required',
            'lokasi_pkm'        => 'required',
        ]);

        $data = Pengabdian::create([
            'periode_id'        => $request->periode_id,
            'judul_pkm'         => $request->judul_pkm,
            'nama_komunitas'    => $request->nama_komunitas,
            'lokasi_pkm'        => $request->lokasi_pkm,
        ]);

        if ($data) {
            return redirect()->route('pengabdian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengabdian $pengabdian)
    {
        $periode = DB::table('periodes')->get();
        return view('pengabdian.edit', compact('pengabdian', 'periode'));
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        $pengabdian = Pengabdian::findOrFail($pengabdian->id);

        $pengabdian->update([
            'judul_pkm'         => $request->judul_pkm,
            'nama_komunitas'    => $request->nama_komunitas,
            'lokasi_pkm'        => $request->lokasi_pkm,
            'periode_id'        => $request->periode_id
        ]);

        if ($pengabdian) {
            return redirect()->route('pengabdian.index')->with('success', 'Judul PKM ' . $pengabdian["judul_pkm"] . ' Updated successfully');
        }
    }

    public function destroy(Pengabdian $pengabdian)
    {
        $pengabdian->find($pengabdian->id)->all();

        $pengabdian->delete();

        if ($pengabdian) {
            return redirect()->route('pengabdian.index')->with('success', 'Judul Pengabdian ' . $pengabdian["judul_pkm"] . ' deleted successfully');
        }
    }
}
