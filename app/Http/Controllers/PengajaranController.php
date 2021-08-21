<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Exports\PengajaransExport;
use App\Models\Dosen;
use App\Models\Pengajaran;
use App\Models\Periode;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PengajaranController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index(Request $request)
    {
        $uri = \Request::getRequestUri();
        $this->authorize('view', Pengajaran::class);

        $user = Auth::user()->username;
        $periode = Periode::all();
        if (Auth::user()->role_id !== 3) {
            $data = Pengajaran::orderBy('created_at', 'desc')->get();
        } else {
            $dosen = Dosen::where('user_id', '=', $user)
                ->orderBy('created_at', 'asc')
                ->get();
            $data = Pengajaran::where('dosen_id', $dosen[0]->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('pengajaran.index', compact('periode', 'data', 'uri'));
    }

    public function search(Request $request)
    {
        $uri = \Request::getRequestUri();
        $user = Auth::user()->username;
        $periode = Periode::all();
        $search = $request->search;
        if (Auth::user()->role_id !== 3) {
            $data = Pengajaran::orderBy('created_at', 'desc')
                ->where('pengajarans.periode_id', '=', $search)
                ->get();
        } else {
            $dosen = Dosen::where('user_id', '=', $user)
                ->orderBy('created_at', 'asc')
                ->get();
            $data = Pengajaran::orderBy('created_at', 'desc')
                ->where('pengajarans.dosen_id', $dosen[0]->id)
                ->where('pengajarans.periode_id', '=', $search)
                ->get();
        }
        return view('pengajaran.index', compact('data', 'periode', 'uri'));
    }

    public function add()
    {
        $this->authorize('create', Pengajaran::class);

        $data = Periode::all();
        $user = Auth::user()->username;
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
        return view('pengajaran.add1', compact('data', 'dosen'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Pengajaran::class);

        // $this->validate($request, [
        //     'kode_mk'   => 'required',
        //     'nama_mk'   => 'required',
        //     'kelas'     => 'required',
        //     'sks'       => 'required',
        // ]);

        // $pengajaran = Pengajaran::where('kode_mk', $request->kode_mk)->first();

        // if ($pengajaran) {
        //     return redirect()->route('pengajaran.index')->with('warning', 'Data already exists');
        // } else {
            $row = $request->row;
            for ($i=0; $i < $row; $i++) {
                $data = Pengajaran::create([
                    'dosen_id'   => $request->dosen_id,
                    'periode_id' => $request->periode_id,
                    'status_id'  => 9,
                    'kode_mk'    => 0,
                    'nama_mk'    => '-',
                    'kelas'      => '-',
                    'sks'        => 0,
                ]);
            }

            if ($data) {
                return redirect()->route('pengajaran.index')->with('success', 'Data added successfully');
            }
        // }

    }

    public function edit(Pengajaran $pengajaran)
    {
        $this->authorize('update', Pengajaran::class);

        $period = Periode::all();
        $status = Status::where('group', '=', 'pengajaran')->get();
        $dosen = DB::table('dosens')
            ->where('status', '=', 'aktif')
            ->get();
        return view('pengajaran.edit', compact('pengajaran', 'period', 'status', 'dosen'));
    }

    public function update(Request $request, Pengajaran $pengajaran)
    {
        $this->authorize('update', Pengajaran::class);

        $pengajaran = Pengajaran::findOrFail($pengajaran->id);

        $this->validate($request, [
            'kode_mk'   => 'required',
            'nama_mk'   => 'required',
            'kelas'     => 'required',
            'sks'       => 'required',
        ]);

        if ($request->kode_mk == 0 || $request->nama_mk == '-' || $request->kelas == '-' || $request->sks == 0) {
            return redirect()->route('pengajaran.index')->with('warning', 'Data failed to update! Isi data terlebih dahulu');
        } else {
            $pengajaran->update([
                'kode_mk'      => $request->kode_mk,
                'nama_mk'      => $request->nama_mk,
                'periode_id'   => $request->periode_id,
                'kelas'        => $request->kelas,
                'sks'          => $request->sks,
                'status_id'    => 11,
            ]);
            return redirect()->route('pengajaran.index')->with('success', 'Judul PKM ' . $pengajaran["kode_mk"] . ' Updated successfully');
        }


        // if ($request->periode_id == 1) {
        //     return redirect()->route('pengajaran.edit', $pengajaran)->with('warning', 'Silahkan pilih periode terlebih dahulu');
        // } else {
        //     if (Auth::user()->role_id == 1) {
        //         $pengajaran->update([
        //             'kode_mk'      => $request->kode_mk,
        //             'nama_mk'      => $request->nama_mk,
        //             'periode_id'   => $request->periode_id,
        //             'kelas'        => $request->kelas,
        //             'sks'          => $request->sks,
        //             'status_id'    => $request->status_id,
        //         ]);
        //     } else if ($request->status_id == 9 || Auth::user()->role_id == 2) {
        //         $pengajaran->update([
        //             'kode_mk'      => $request->kode_mk,
        //             'nama_mk'      => $request->nama_mk,
        //             'periode_id'   => $request->periode_id,
        //             'kelas'        => $request->kelas,
        //             'sks'          => $request->sks,
        //             'status_id'    => 10,
        //         ]);
        //     }

        // }
    }

    public function destroy(Pengajaran $pengajaran)
    {
        $this->authorize('delete', Pengajaran::class);

        $pengajaran->find($pengajaran->id)->all();

        $pengajaran->delete();

        if ($pengajaran) {
            return redirect()->route('pengajaran.index')->with('success', 'Kode MK ' . $pengajaran["kode_mk"] . ' deleted successfully');
        }
    }

    public function report()
    {
        $this->authorize('viewReport', Pengajaran::class);

        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('pengajaran.report', compact('dosen'));
    }

    public function export(Request $request)
    {
        $this->authorize('viewReport', Pengajaran::class);

        $from = date($request->from);
        $to = date($request->to);

        Pengajaran::whereBetween('created_at', [$from, $to])->get();
        return Excel::download(new PengajaransExport, 'pengajaran-'.$from . '_sd_'.$to.'.xlsx');
    }

    public function generatePDF($id)
    {
        $data = Pengajaran::findOrFail($id);
        $user = Auth::user()->username;
        $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->get();
        if (Auth::user()->role_id !== 3) {
            $data = Pengajaran::orderBy('created_at', 'desc')
                ->where('id', $id)
                ->get();
        } else {
            $data = Pengajaran::where('dosen_id', $dosen[0]->id)
                ->where('id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $pdf = PDF::loadView('pengajaran.pdf', compact('data'));
        return $pdf->download('pengajaran.pdf');
    }
}
