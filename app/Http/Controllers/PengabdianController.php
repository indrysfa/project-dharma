<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Exports\PengabdiansExport;
use App\Models\Pengabdian;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PengabdianController extends Controller
{
    public function index()
    {
        $periode = DB::table('periodes')->first();
        $user = Auth::user()->username;
        if (Auth::user()->role_id !== 3) {
            $data = Pengabdian::orderBy('created_at')->get();
        } else {
            $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->get();
            $data = Pengabdian::where('dosen_id', $dosen[0]->id)->get();
        }
        return view('pengabdian.index', compact('data', 'periode'));
    }

    public function create()
    {
        $this->authorize('create', Pengabdian::class);

        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        $periode = DB::table('periodes')->get();
        return view('pengabdian.add', compact('periode', 'dosen'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Pengabdian::class);

        $this->validate($request, [
            'dosen_id'          => 'required',
            'periode_id'        => 'required',
            'judul_pkm'         => 'required',
            'nama_komunitas'    => 'required',
            'lokasi_pkm'        => 'required',
        ]);

        $data = Pengabdian::create([
            'dosen_id'          => $request->dosen_id,
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
        $this->authorize('update', Pengabdian::class);

        $periode = DB::table('periodes')->get();
        return view('pengabdian.edit', compact('pengabdian', 'periode'));
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        $this->authorize('update', Pengabdian::class);

        $pengabdian = Pengabdian::findOrFail($pengabdian->id);

        $pengabdian->update([
            'periode_id'        => $request->periode_id,
            'judul_pkm'         => $request->judul_pkm,
            'nama_komunitas'    => $request->nama_komunitas,
            'lokasi_pkm'        => $request->lokasi_pkm,
        ]);

        if ($pengabdian) {
            return redirect()->route('pengabdian.index')->with('success', 'Judul PKM ' . $pengabdian["judul_pkm"] . ' Updated successfully');
        }
    }

    public function destroy(Pengabdian $pengabdian)
    {
        $this->authorize('delete', Pengabdian::class);

        $pengabdian->find($pengabdian->id)->all();

        $pengabdian->delete();

        if ($pengabdian) {
            return redirect()->route('pengabdian.index')->with('success', 'Judul Pengabdian ' . $pengabdian["judul_pkm"] . ' deleted successfully');
        }
    }

    public function report()
    {
        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('pengabdian.report', compact('dosen'));
    }

    public function export(Request $request)
    {
        $from = date($request->from);
        $to = date($request->to);

        Pengabdian::whereBetween('created_at', [$from, $to])->get();
        return Excel::download(new PengabdiansExport, 'pkm-'.$from . '_sd_'.$to.'.xlsx');
    }
}
