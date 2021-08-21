<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Exports\PengabdiansExport;
use App\Models\Dosen;
use App\Models\Pengabdian;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PengabdianController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index()
    {
        $this->authorize('view', Pengabdian::class);

        $user = Auth::user()->username;
        if (Auth::user()->role_id !== 3) {
            $data = Pengabdian::orderBy('created_at', 'desc')->get();
        } else {
            $dosen = Dosen::where('user_id', '=', $user)
                ->orderBy('created_at', 'asc')
                ->get();
            $data = Pengabdian::where('dosen_id', $dosen[0]->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('pengabdian.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Pengabdian::class);

        $user = Auth::user()->username;
        $periode = Periode::all();
        if (Auth::user()->role_id === 3) {
            $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->first();
        } else {
            $dosen = Dosen::where('status', 'aktif')
                ->where('dosens.status', 'aktif')
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return view('pengabdian.add1', compact('dosen', 'periode'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Pengabdian::class);

        // $this->validate($request, [
        //     'dosen_id'          => 'required',
        //     'judul_pkm'         => 'required',
        //     'nama_komunitas'    => 'required',
        //     'lokasi_pkm'        => 'required',
        // ]);

        // $data = Pengabdian::create([
        //     'dosen_id'          => $request->dosen_id,
        //     'periode_id'        => $request->periode_id,
        //     'status_id'         => 13,
        //     'tgl_pengabdian'    => $request->tgl_pengabdian,
        //     'judul_pkm'         => $request->judul_pkm,
        //     'nama_komunitas'    => $request->nama_komunitas,
        //     'lokasi_pkm'        => $request->lokasi_pkm,
        // ]);

        $row = $request->row;
        for ($i=0; $i < $row; $i++) {
            $data = Pengabdian::create([
                'dosen_id'          => $request->dosen_id,
                'periode_id'        => $request->periode_id,
                'status_id'         => 13,
                'judul_pkm'         => '-',
                'nama_komunitas'    => '-',
                'lokasi_pkm'        => '-',
            ]);
        }

        if ($data) {
            return redirect()->route('pengabdian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengabdian $pengabdian)
    {
        $this->authorize('update', Pengabdian::class);

        $periode = DB::table('periodes')->get();
        $status = DB::table('statuses')
            ->where('group', '=', 'pengabdian')
            ->get();
        return view('pengabdian.edit', compact('pengabdian', 'periode', 'status'));
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        $this->authorize('update', Pengabdian::class);

        $pengabdian = Pengabdian::findOrFail($pengabdian->id);

        // if ($request->periode_id == 1) {
        //     return redirect()->route('pengabdian.edit', $pengabdian)->with('warning', 'Silahkan pilih periode terlebih dahulu');
        // } else {
        //     if (Auth::user()->role_id == 1) {
        //         $pengabdian->update([
        //             'periode_id'        => $request->periode_id,
        //             'tanggal'           => $request->tanggal,
        //             'status_id'         => $request->status_id,
        //             'judul_pkm'         => $request->judul_pkm,
        //             'nama_komunitas'    => $request->nama_komunitas,
        //             'lokasi_pkm'        => $request->lokasi_pkm,
        //         ]);
        //     } else if ($request->status_id == 13 || Auth::user()->role_id == 2) {
        //         $pengabdian->update([
        //             'periode_id'        => $request->periode_id,
        //             'tanggal'           => $request->tanggal,
        //             'status_id'         => 15,
        //             'judul_pkm'         => $request->judul_pkm,
        //             'nama_komunitas'    => $request->nama_komunitas,
        //             'lokasi_pkm'        => $request->lokasi_pkm,
        //         ]);
        //     }
        //     return redirect()->route('pengabdian.index')->with('success', 'Judul PKM ' . $pengabdian["judul_pkm"] . ' Updated successfully');
        // }

        $this->validate($request, [
            'tgl_pengabdian'    => 'required',
            'judul_pkm'         => 'required',
            'nama_komunitas'    => 'required',
            'lokasi_pkm'        => 'required',
        ]);

        if ($request->tgl_pengabdian == null || $request->judul_pkm == '-' || $request->nama_komunitas == '-' || $request->lokasi_pkm == '-') {
            return redirect()->route('pengabdian.index')->with('warning', 'Data failed to update! Isi data terlebih dahulu');
        } else {
            $pengabdian->update([
                'periode_id'        => $request->periode_id,
                'dosen_id'          => $request->dosen_id,
                'judul_pkm'         => $request->judul_pkm,
                'nama_komunitas'    => $request->nama_komunitas,
                'lokasi_pkm'        => $request->lokasi_pkm,
                'status_id'         => 11,
            ]);
            return redirect()->route('pengabdian.index')->with('success', 'Updated successfully');
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
        $this->authorize('viewReport', Pengabdian::class);

        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('pengabdian.report', compact('dosen'));
    }

    public function export(Request $request)
    {
        $this->authorize('viewReport', Pengabdian::class);

        $from = date($request->from);
        $to = date($request->to);

        Pengabdian::whereBetween('created_at', [$from, $to])->get();
        return Excel::download(new PengabdiansExport, 'pkm-'.$from . '_sd_'.$to.'.xlsx');
    }

    public function generatePDF($id)
    {
        $data = Pengabdian::findOrFail($id);

        $user = Auth::user()->username;
        $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->get();
        if (Auth::user()->role_id !== 3) {
            $data = Pengabdian::orderBy('created_at', 'desc')
                ->where('id', $id)
                ->get();
        } else {
            $data = Pengabdian::where('dosen_id', $dosen[0]->id)
                ->where('id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $pdf = PDF::loadView('pengabdian.pdf', compact('data'));
        return $pdf->download('pengabdian.pdf');
    }
}
