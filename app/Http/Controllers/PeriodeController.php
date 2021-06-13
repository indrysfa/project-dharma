<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $data = Periode::all();
        return view('master.periode-index', compact('data'));
    }

    public function add()
    {
        return view('master.periode-add');
    }

    public function create(Request $request)
    {
        $data = Periode::create([
            'tahun'     => $request->tahun,
            'semester'  => $request->semester
        ]);

        if ($data) {
            return redirect()->route('periode.index');
        }
    }

    public function destroy(Periode $periode)
    {
        $periode->find($periode->id)->all();

        $periode->delete();

        if ($periode) {
            return redirect()->route('periode.index')->with('success', 'periode deleted successfully');
        }
    }
}
