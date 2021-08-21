<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Exports\PengembangansExport;
use App\Models\Dosen;
use App\Models\Pengembangan;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PengembanganController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index()
    {
        $this->authorize('view', Pengembangan::class);

        $periode = DB::table('periodes')->first();
        $user = Auth::user()->username;
        if (Auth::user()->role_id !== 3) {
            $data = Pengembangan::orderBy('created_at', 'DESC')->get();
        } else {
            $dosen = Dosen::where('user_id', '=', $user)
                ->orderBy('created_at', 'asc')
                ->get();
            $data = Pengembangan::where('dosen_id', isset($dosen[0]->id))
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('pengembangan.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Pengembangan::class);

        $user = Auth::user()->username;
        $periode = Periode::all();
        $jenis_pengdiri = DB::table('jenis_pengdiris')->get();
        if (Auth::user()->role_id === 3) {
            $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->first();
        } else {
            $dosen = Dosen::where('status', 'aktif')
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        return view('pengembangan.add1', compact('jenis_pengdiri', 'dosen', 'periode'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Pengembangan::class);

        // $this->validate($request, [
        //     'dosen_id'          => 'required',
        //     'tanggal'           => 'required',
        //     'jenis_pengdiri_id' => 'required',
        //     'judul_pengdiri'    => 'required',
        //     'lokasi_pengdiri'   => 'required',
        // ]);

        // $data = Pengembangan::create([
        //     'dosen_id'          => $request->dosen_id,
        //     'tanggal'           => $request->tanggal,
        //     'periode_id'        => 1,
        //     'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
        //     'status_id'         => 17,
        //     'judul_pengdiri'    => $request->judul_pengdiri,
        //     'lokasi_pengdiri'   => $request->lokasi_pengdiri,
        // ]);

        $row = $request->row;
        for ($i=0; $i < $row; $i++) {
            $data = Pengembangan::create([
                'dosen_id'          => $request->dosen_id,
                'periode_id'        => $request->periode_id,
                'status_id'         => 17,
                'judul_pengdiri'    => '-',
                'lokasi_pengdiri'   => '-',
            ]);
        }

        if ($data) {
            return redirect()->route('pengembangan.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengembangan $pengembangan)
    {
        $this->authorize('update', Pengembangan::class);

        $periode        = DB::table('periodes')->get();
        $jenis_pengdiri = DB::table('jenis_pengdiris')->get();
        $status         = DB::table('statuses')
                            ->where('group', '=', 'pengembangan')
                            ->get();
        return view('pengembangan.edit', compact('pengembangan', 'periode', 'jenis_pengdiri', 'status'));
    }

    public function update(Request $request, Pengembangan $pengembangan)
    {
        $this->authorize('update', Pengembangan::class);

        $pengembangan = Pengembangan::findOrFail($pengembangan->id);

        // if ($request->periode_id == 1) {
        //     return redirect()->route('pengembangan.edit', $pengembangan)->with('warning', 'Silahkan pilih periode terlebih dahulu');
        // } else {
        //     if (Auth::user()->role_id == 1) {
        //         $pengembangan->update([
        //             'periode_id'        => $request->periode_id,
        //             'tanggal'           => $request->tanggal,
        //             'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
        //             'judul_pengdiri'    => $request->judul_pengdiri,
        //             'lokasi_pengdiri'   => $request->lokasi_pengdiri,
        //             'status_id'         => $request->status_id,
        //         ]);
        //     } else if ($request->status_id == 17 || Auth::user()->role_id == 2) {
        //         $pengembangan->update([
        //             'periode_id'        => $request->periode_id,
        //             'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
        //             'judul_pengdiri'    => $request->judul_pengdiri,
        //             'lokasi_pengdiri'   => $request->lokasi_pengdiri,
        //             'status_id'         => 19,
        //         ]);
        //     }

        //     return redirect()->route('pengembangan.index')->with('success', 'Judul pengembangan ' . $pengembangan["judul_pengdiri"] . ' Updated successfully');
        // }

        $this->validate($request, [
            'tgl_pengembangan'  => 'required',
            'jenis_pengdiri_id' => 'required',
            'judul_pengdiri'    => 'required',
            'lokasi_pengdiri'   => 'required',
        ]);

        if ($request->tgl_pengembangan == null || $request->jenis_pengdiri_id == null || $request->judul_pengdiri == '-' || $request->lokasi_pengdiri == '-') {
            return redirect()->route('pengembangan.index')->with('warning', 'Data failed to update! Isi data terlebih dahulu');
        } else {
            $pengembangan->update([
                'periode_id'        => $request->periode_id,
                'dosen_id'          => $request->dosen_id,
                'jenis_pengdiri_id' => $request->jenis_pengdiri_id,
                'judul_pengdiri'    => $request->judul_pengdiri,
                'lokasi_pengdiri'   => $request->lokasi_pengdiri,
                'status_id'         => 19,
            ]);
            return redirect()->route('pengembangan.index')->with('success', 'Updated successfully');
        }
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
            ->orderBy('dosens.created_at', 'DESC')
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

    public function generatePDF($id)
    {
        $data = Pengembangan::findOrFail($id);

        $user = Auth::user()->username;
        $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->get();
        if (Auth::user()->role_id !== 3) {
            $data = Pengembangan::orderBy('created_at', 'desc')
                ->where('id', $id)
                ->get();
        } else {
            $data = Pengembangan::where('dosen_id', $dosen[0]->id)
                ->where('id', $id)
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        $pdf = PDF::loadView('pengembangan.pdf', compact('data'));
        return $pdf->download('pengembangan.pdf');
    }
}
