<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use Illuminate\Http\Request;

class PengabdianController extends Controller
{
    public function index()
    {
        $data = Pengabdian::all();
        return view('pengabdian.index', compact('data'));
    }

    public function add()
    {
        return view('pengabdian.add');
    }

    public function create(Request $request)
    {
        $data = Pengabdian::create([
            'judul_pkm'         => $request->judul_pkm,
            'nama_komunitas'    => $request->nama_komunitas,
            'lokasi_pkm'        => $request->lokasi_pkm,
            'periode_id'        => $request->periode_id
        ]);

        if ($data) {
            return redirect()->route('pengabdian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengabdian $pengabdian)
    {
        return view('pengabdian.edit', compact('pengabdian'));
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
