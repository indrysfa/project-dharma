<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use Illuminate\Http\Request;

class PenelitianController extends Controller
{
    public function index()
    {
        $data = Penelitian::all();
        return view('penelitian.index', compact('data'));
    }

    public function add()
    {
        return view('penelitian.add');
    }

    public function create(Request $request)
    {
        $data = Penelitian::create([
            'judul_penelitian'  => $request->judul_penelitian,
            'status_penelitian' => $request->status_penelitian,
            'jumlah_anggota'    => $request->jumlah_anggota,
            'tahun_penelitian'  => $request->tahun_penelitian
        ]);

        if ($data) {
            return redirect()->route('penelitian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Penelitian $penelitian)
    {
        return view('penelitian.edit', compact('penelitian'));
    }

    public function update(Request $request, Penelitian $penelitian)
    {
        $penelitian = Penelitian::findOrFail($penelitian->id);

        $penelitian->update([
            'judul_penelitian'  => $request->judul_penelitian,
            'status_penelitian' => $request->status_penelitian,
            'jumlah_anggota'    => $request->jumlah_anggota,
            'tahun_penelitian'  => $request->tahun_penelitian
        ]);

        if ($penelitian) {
            return redirect()->route('penelitian.index')->with('success', 'Judul Penelitian ' . $penelitian["judul_penelitian"] . ' Updated successfully');
        }
    }

    public function destroy(Penelitian $penelitian)
    {
        $penelitian->find($penelitian->id)->all();

        $penelitian->delete();

        if ($penelitian) {
            return redirect()->route('penelitian.index')->with('success', 'Judul Penelitian ' . $penelitian["judul_penelitian"] . ' deleted successfully');
        }
    }
}
