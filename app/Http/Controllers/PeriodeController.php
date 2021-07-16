<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $data = Periode::all();
        return view('master.periode', compact('data'));
    }

    public function create()
    {
        return view('master.periode-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun'     => 'required',
            'semester'  => 'required',
        ]);

        $periode = Periode::first();
        // dd($request->tahun);
        
        if($request->tahun != $periode->tahun &&  $request->semester != $periode->semester) {
            Periode::create($request->all());
            return redirect()->route('periode.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('periode.index')->with('warning', 'Gagal! Data sudah ada');
        }
    }

    public function destroy(Periode $periode)
    {
        $periode->find($periode->id)->all();

        $periode->delete();

        if ($periode) {
            return redirect()->route('periode.index')->with('success', 'Periode Tahun '. $periode->tahun . ' Semester '. $periode->semester .' berhasil dihapus');
        }
    }
}
