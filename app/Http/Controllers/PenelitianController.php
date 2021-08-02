<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/

namespace App\Http\Controllers;

use App\Exports\PenelitiansExport;
use App\Models\Dosen;
use App\Models\Penelitian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PenelitianController extends Controller
{
    public function index()
    {
        $user = Auth::user()->username;
        if (Auth::user()->role_id !== 3) {
            $data = Penelitian::orderBy('created_at')->get();
        } else {
            $dosen = DB::table('dosens')
                ->where('user_id', '=', $user)
                ->get();
            $data = Penelitian::where('dosen_id', $dosen[0]->id)->get();
        }
        return view('penelitian.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('create', Penelitian::class);

        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        $periode = DB::table('periodes')
            ->where('semester', '=', 1)
            ->get();
        $status = DB::table('statuses')
            ->where('group', '=', 'penelitian')
            ->get();
        return view('penelitian.add', compact('periode', 'status', 'dosen'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Penelitian::class);

        $this->validate($request, [
            'dosen_id'          => 'required',
            'judul_penelitian'  => 'required',
            'jumlah_anggota'    => 'required',
        ]);

        $data = Penelitian::create([
            'dosen_id'          => $request->dosen_id,
            'status_id'         => $request->status_id,
            'periode_id'        => $request->periode_id,
            'judul_penelitian'  => $request->judul_penelitian,
            'jumlah_anggota'    => $request->jumlah_anggota,
        ]);

        if ($data) {
            return redirect()->route('penelitian.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Penelitian $penelitian)
    {
        $this->authorize('update', Penelitian::class);

        $periode = DB::table('periodes')
            ->where('semester', '=', 1)
            ->get();
        $status = DB::table('statuses')
            ->where('group', '=', 'penelitian')
            ->get();
        $dosen = DB::table('dosens')
            ->where('status', '=', 'aktif')
            ->get();
        return view('penelitian.edit', compact('penelitian', 'periode', 'status', 'dosen'));
    }

    public function update(Request $request, Penelitian $penelitian)
    {
        $this->authorize('update', Penelitian::class);

        $penelitian = Penelitian::findOrFail($penelitian->id);

        $penelitian->update([
            'periode_id'        => $request->periode_id,
            'status_id'         => $request->status_id,
            'judul_penelitian'  => $request->judul_penelitian,
            'jumlah_anggota'    => $request->jumlah_anggota,
        ]);

        if ($penelitian) {
            return redirect()->route('penelitian.index')->with('success', 'Judul Penelitian ' . $penelitian["judul_penelitian"] . ' Updated successfully');
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
        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('penelitian.report', compact('dosen'));
    }

    public function export(Request $request)
    {
        // $dosen = date($request->dosen);
        // $dosen = date("Y-m-d H:i:s", strtotime($request->from));
        $from = date($request->from);
        $to = date($request->to);

        Penelitian::whereBetween('created_at', [$from, $to])->get();
        // dd($dosen);
        return Excel::download(new PenelitiansExport, 'penelitian-'.$from . '_sd_'.$to.'.xlsx');
    }

    // public function import()
    // {
    //     Excel::import(new UsersImport,request()->file('file'));

    //     return back();
    // }
}
