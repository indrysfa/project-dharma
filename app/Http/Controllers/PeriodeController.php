<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // $periode = Periode::get();
        $periode = DB::table('periodes')
            // ->where('tahun', '!=', $request->tahun)
            // ->where('semester', '!=', $request->semester)
            // ->groupBy('tahun')
            ->get();
            // dd($cekperiode);

        if($request->tahun != $periode->tahun &&  $request->semester != $periode->semester) {
        // if($cekperiode) {
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
