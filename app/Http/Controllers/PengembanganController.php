<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Exports\PengabdiansExport;
use App\Exports\PengembangansExport;
use App\Models\Dosen;
use App\Models\Pengembangan;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isEmpty;

class PengembanganController extends Controller
{
    public function index()
    {
        $periode = DB::table('periodes')->first();
        $user = Auth::user()->username;
        $status = DB::table('statuses')
            ->where('group', '=', 'pengembangan')
            ->get();
        if (Auth::user()->role_id !== 3) {
            $data = Pengembangan::orderBy('created_at')->get();
        } else {
            // $dosen = Dosen::where('user_id', $user)->first();
            $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->get();
            $data = Pengembangan::where('dosen_id', isset($dosen[0]->id))->get();
        }
        // print_r($data);
        // $datas = Pengembangan::all();
       return view('pengembangan.index', compact('data', 'status'));
    }

    public function create()
    {
        $this->authorize('create', Pengembangan::class);

        $periode        = DB::table('periodes')->get();
        $jenis_pengdiri = DB::table('jenis_pengdiris')->get();
        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        // $status = DB::table('statuses')
        //     ->where('group', '=', 'pengembangan')
        //     ->get();
        return view('pengembangan.add', compact('periode', 'jenis_pengdiri', 'dosen'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Pengembangan::class);

        $this->validate($request, [
            'dosen_id'          => 'required',
            'jenis_pengdiri_id' => 'required',
            'judul_pengdiri'    => 'required',
            'lokasi_pengdiri'   => 'required',
        ]);

        $data = Pengembangan::create([
            'dosen_id'          => $request->dosen_id,
            'periode_id'        => 1,
            'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
            'status_id'         => 17,
            'judul_pengdiri'    => $request->judul_pengdiri,
            'lokasi_pengdiri'   => $request->lokasi_pengdiri,
        ]);

        if ($data) {
            return redirect()->route('pengembangan.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengembangan $pengembangan)
    {
        $this->authorize('update', Pengembangan::class);

        $periode        = DB::table('periodes')->get();
        $jenis_pengdiri = DB::table('jenis_pengdiris')->get();
        // dd($periode);
        return view('pengembangan.edit', compact('pengembangan', 'periode', 'jenis_pengdiri'));
    }

    public function update(Request $request, Pengembangan $pengembangan)
    {
        $this->authorize('update', Pengembangan::class);

        $pengembangan = Pengembangan::findOrFail($pengembangan->id);

        if ($request->periode_id == 1) {
            return redirect()->route('pengembangan.edit', $pengembangan)->with('warning', 'Silahkan pilih periode terlebih dahulu');
        } else {
            $pengembangan->update([
                'periode_id'        => $request->periode_id,
                'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
                'judul_pengdiri'    => $request->judul_pengdiri,
                'lokasi_pengdiri'   => $request->lokasi_pengdiri,
                'status_id'         => 18,
            ]);

            return redirect()->route('pengembangan.index')->with('success', 'Judul pengembangan ' . $pengembangan["judul_pengdiri"] . ' Updated successfully');
        }

        // if ($pengembangan) {
        //     return redirect()->route('pengembangan.index')->with('success', 'Judul pengembangan ' . $pengembangan["judul_pengdiri"] . ' Updated successfully');
        // }
    }

    public function destroy(Pengembangan $pengembangan)
    {
        $this->authorize('delete', Pengembangan::class);

        $pengembangan->find($pengembangan->id)->all();

        $pengembangan->delete();

        if ($pengembangan) {
            return redirect()->route('pengembangan.index')->with('success', 'Judul pengembangan ' . $pengembangan["judul_pengdiri"] . ' deleted successfully');
        }
    }

    public function report()
    {
        $this->authorize('viewReport', Pengembangan::class);

        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('pengembangan.report', compact('dosen'));
    }

    public function export(Request $request, Dosen $dosen)
    {
        $this->authorize('viewReport', Pengembangan::class);

        $from = date($request->from);
        $to = date($request->to);
        $dosen = Dosen::findOrFail($dosen->id);
        // dd($dosen);
        Pengembangan::whereBetween('created_at', [$from, $to])
            ->where('dosen_id', $dosen)
            ->get();
        return Excel::download(new PengembangansExport, 'pengembangan-diri-'.$from . '_sd_'.$to.'.xlsx');
    }
}
