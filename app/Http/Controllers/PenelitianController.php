<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/

namespace App\Http\Controllers;

use App\Exports\PenelitiansExport;
use App\Models\Dosen;
use App\Models\Jenis_penelitian;
use App\Models\Penelitian;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PenelitianController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index()
    {
        $this->authorize('view', Penelitian::class);

        $user = Auth::user()->username;
        if (Auth::user()->role_id !== 3) {
            $data = Penelitian::orderBy('created_at', 'desc')->get();
        } else {
            $dosen = Dosen::where('user_id', '=', $user)
                ->orderBy('created_at', 'asc')
                ->get();
            $data = Penelitian::where('dosen_id', $dosen[0]->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('penelitian.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Penelitian::class);

        $user = Auth::user()->username;
        $jenis_penelitian = Jenis_penelitian::all();
        $periode = Periode::where('semester', 1)->get();
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
        return view('penelitian.add1', compact('dosen', 'jenis_penelitian', 'periode'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Penelitian::class);

        // $this->validate($request, [
        //     'dosen_id'              => 'required',
        //     'jenis_penelitian_id'   => 'required',
        //     'judul_penelitian'      => 'required',
        //     'jumlah_anggota'        => 'required',
        // ]);

        // $data = Penelitian::create([
        //     'dosen_id'              => $request->dosen_id,
        //     'jenis_penelitian_id'   => $request->jenis_penelitian_id,
        //     'status_id'             => 5,
        //     'periode_id'            => 1,
        //     'judul_penelitian'      => $request->judul_penelitian,
        //     'jumlah_anggota'        => $request->jumlah_anggota,
        // ]);

        $row = $request->row;
            for ($i=0; $i < $row; $i++) {
                $data = Penelitian::create([
                    'dosen_id'              => $request->dosen_id,
                    'status_id'             => 5,
                    'periode_id'            => $request->periode_id,
                    'judul_penelitian'      => '-',
                    'jumlah_anggota'        => 0,
                ]);
            }
        // dd($data);

        if ($data) {
            return redirect()->route('penelitian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Penelitian $penelitian)
    {
        $this->authorize('update', Penelitian::class);

        $jenis_penelitian = Jenis_penelitian::all();
        $periode = DB::table('periodes')
            ->where('semester', '=', 1)
            ->get();
        $status = DB::table('statuses')
            ->where('group', '=', 'penelitian')
            ->get();
        $dosen = DB::table('dosens')
            ->where('status', '=', 'aktif')
            ->get();
        return view('penelitian.edit', compact('penelitian', 'periode', 'status', 'dosen', 'jenis_penelitian'));
    }

    public function update(Request $request, Penelitian $penelitian)
    {
        $this->authorize('update', Penelitian::class);

        $penelitian = Penelitian::findOrFail($penelitian->id);

        // if ($request->periode_id == 1) {
        //     return redirect()->route('penelitian.edit', $penelitian)->with('warning', 'Silahkan pilih periode terlebih dahulu');
        // } else {
        //     if (Auth::user()->role_id == 1) {
        //         $penelitian->update([
        //             'periode_id'            => $request->periode_id,
        //             'jenis_penelitian_id'   => $request->jenis_penelitian_id,
        //             'status_id'             => $request->status_id,
        //             'judul_penelitian'      => $request->judul_penelitian,
        //             'jumlah_anggota'        => $request->jumlah_anggota,
        //         ]);
        //     } else if ($request->status_id == 5 || Auth::user()->role_id == 2) {
        //         $penelitian->update([
        //             'periode_id'            => $request->periode_id,
        //             'jenis_penelitian_id'   => $request->jenis_penelitian_id,
        //             'status_id'             => 7,
        //             'judul_penelitian'      => $request->judul_penelitian,
        //             'jumlah_anggota'        => $request->jumlah_anggota,
        //         ]);
        //     }
        //     return redirect()->route('penelitian.index')->with('success', 'Judul PKM ' . $penelitian["judul_pkm"] . ' Updated successfully');
        // }

        $this->validate($request, [
            'jenis_penelitian_id'   => 'required',
            'tgl_penelitian'        => 'required',
            'judul_penelitian'      => 'required',
            'jumlah_anggota'        => 'required',
        ]);

        if ($request->judul_penelitian == '' || $request->jumlah_anggota == 0 || $request->jenis_penelitian_id == null) {
            return redirect()->route('penelitian.index')->with('warning', 'Data failed to update! Isi data terlebih dahulu');
        } else {
            $penelitian->update([
                'dosen_id'              => $request->dosen_id,
                'jenis_penelitian_id'   => $request->jenis_penelitian_id,
                'periode_id'            => $request->periode_id,
                'tgl_penelitian'        => $request->tgl_penelitian,
                'judul_penelitian'      => $request->judul_penelitian,
                'jumlah_anggota'        => $request->jumlah_anggota,
                'status_id'             => 7,
            ]);
            return redirect()->route('penelitian.index')->with('success', ' Updated successfully');
        }
    }

    public function destroy(Penelitian $penelitian)
    {
        $this->authorize('delete', Penelitian::class);

        $penelitian->find($penelitian->id)->all();

        $penelitian->delete();

        if ($penelitian) {
            return redirect()->route('penelitian.index')->with('success', 'Judul Penelitian ' . $penelitian["judul_penelitian"] . ' deleted successfully');
        }
    }

    public function report()
    {
        $this->authorize('viewReport', Penelitian::class);

        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('penelitian.report', compact('dosen'));
    }

    public function export(Request $request)
    {
        $this->authorize('aktif', User::class);
        $this->authorize('viewReport', Penelitian::class);

        // $dosen = date($request->dosen);
        // $dosen = date("Y-m-d H:i:s", strtotime($request->from));
        $from = date($request->from);
        $to = date($request->to);

        Penelitian::whereBetween('created_at', [$from, $to])->get();
        // dd($dosen);

        // return [
        //     (new PenelitiansExport)->withHeadings('Tanggal', 'Nama Dosen', 'Judul Penelitian', 'Status Penelitian', 'Jumlah Anggota', 'Tahun Penelitian'),
        // ];
        return Excel::download(new PenelitiansExport, 'penelitian-'.$from . '_sd_'.$to.'.xlsx');
    }

    // public function import()
    // {
    //     Excel::import(new UsersImport,request()->file('file'));

    //     return back();
    // }

    public function generatePDF($id)
    {
        $data = Penelitian::findOrFail($id);
        // The next development
        // $datas = [
        //     'dosen_id'          => $data->dosen_id,
        //     'periode_id'        => $data->periode_id,
        //     'status_id'         => $data->status_id,
        //     'judul_penelitian'  => $data->judul_penelitian,
        //     'jumlah_anggota'    => $data->jumlah_anggota,
        // ];
        // dd($datas);

        $user = Auth::user()->username;
        $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->get();
        if (Auth::user()->role_id !== 3) {
            $data = Penelitian::orderBy('created_at', 'desc')
                ->where('id', $id)
                ->get();
        } else {
            $data = Penelitian::where('dosen_id', $dosen[0]->id)
                ->where('id', $id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        $pdf = PDF::loadView('penelitian.pdf', compact('data'));
        // The next development
        // Mail::send('emails.myTestMail', $data, function($message)use($datas, $pdf) {
        //     $message->to(['caturdharma.binus@gmail.com'])
        //             ->subject(['Laporan Penelitian'])
        //             ->attachData($pdf->output(), "penelitian.pdf");
        // });
        return $pdf->download('penelitian.pdf');
    }
}
