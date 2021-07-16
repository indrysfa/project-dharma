<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use App\Models\Periode;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenelitianController extends Controller
{
    public function index()
    {
        $data    = Penelitian::all();
        $periode = Periode::join('penelitians', 'periodes.id', '=', 'penelitians.periode_id')
            ->where('semester', 1)
            ->get();
        return view('penelitian.index', compact('data', 'periode'));
    }

    public function create()
    {
        $periode = DB::table('periodes')
            ->where('semester', '=', 1)
            ->get();
        $status = DB::table('statuses')
            ->where('group', '=', 'penelitian')
            ->get();
        return view('penelitian.add', compact('periode', 'status'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul_penelitian'  => 'required',
            'jumlah_anggota'    => 'required',
        ]);

        $data = Penelitian::create([
            'status_id'         => $request->status_id,
            'periode_id'        => $request->periode_id,
            'judul_penelitian'  => $request->judul_penelitian,
            'jumlah_anggota'    => $request->jumlah_anggota,
        ]);

        if ($data) {
            return redirect()->route('penelitian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Penelitian $penelitian)
    {
        $periode = DB::table('periodes')
            ->where('semester', '=', 1)
            ->get();
        $status = DB::table('statuses')
            ->where('group', '=', 'penelitian')
            ->get();
        return view('penelitian.edit', compact('penelitian', 'periode', 'status'));
    }

    public function update(Request $request, Penelitian $penelitian)
    {
        $penelitian = Penelitian::findOrFail($penelitian->id);

        $penelitian->update([
            'periode_id'        => $request->periode_id,
            'status_id'         => $request->status_id,
            'judul_penelitian'  => $request->judul_penelitian,
            'jumlah_anggota'    => $request->jumlah_anggota,
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
