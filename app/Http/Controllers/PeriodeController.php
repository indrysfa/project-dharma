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

use function PHPUnit\Framework\isEmpty;

class PeriodeController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index()
    {
        $this->authorize('view', Periode::class);

        $data = Periode::all();
        return view('master.periode', compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Periode::class);

        return view('master.periode-add');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Periode::class);

        $request->validate([
            'tahun'     => 'required',
            'semester'  => 'required',
        ]);

        $periode = DB::table('periodes')
            ->where('tahun', 'like', "%" . $request->tahun . "%")
            ->where('semester', 'like', "%" . $request->semester . "%")
            ->first();

        if($periode){
            return redirect()->route('periode.index')->with('warning', 'Gagal! Data sudah ada');
        } else {
            Periode::create([
                'tahun'     => $request->tahun,
                'semester'  => $request->semester,
            ]);
            return redirect()->route('periode.index')->with('success', 'Data berhasil ditambahkan');
        }
    }

    public function destroy(Periode $periode)
    {
        $this->authorize('delete', Periode::class);

        $periode->find($periode->id)->all();

        $periode->delete();

        if ($periode) {
            return redirect()->route('periode.index')->with('success', 'Periode Tahun '. $periode->tahun . ' Semester '. $periode->semester .' berhasil dihapus');
        }
    }
}
