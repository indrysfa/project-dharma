<?php

namespace App\Http\Controllers;

use App\Models\Pengembangan;
use Illuminate\Http\Request;

class PengembanganController extends Controller
{
    public function index()
    {
        $data = Pengembangan::all();
        return view('pengembangan.index', compact('data'));
    }

    public function add()
    {
        return view('pengembangan.add');
    }

    public function create(Request $request)
    {
        $data = Pengembangan::create([
            'jenis_pengdiri'    => $request->jenis_pengdiri,
            'judul_pengdiri'    => $request->judul_pengdiri,
            'lokasi_pengdiri'   => $request->lokasi_pengdiri,
            'periode_id'        => $request->periode_id
        ]);

        if ($data) {
            return redirect()->route('pengembangan.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengembangan $pengembangan)
    {
        return view('pengembangan.edit', compact('pengembangan'));
    }

    public function update(Request $request, Pengembangan $pengembangan)
    {
        $pengembangan = Pengembangan::findOrFail($pengembangan->id);

        $pengembangan->update([
            'jenis_pengdiri'    => $request->jenis_pengdiri,
            'judul_pengdiri'    => $request->judul_pengdiri,
            'lokasi_pengdiri'   => $request->lokasi_pengdiri,
            'periode_id'        => $request->periode_id
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
