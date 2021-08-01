<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengajaran;
use App\Models\Periode;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengajaranController extends Controller
{
    public function index()
    {
        $period = DB::table('periodes')
                ->join('pengajarans', 'periodes.id', '=', 'pengajarans.periode_id')
                ->get();
        $username = Auth::user()->username;
        if (Auth::user()->role_id !== 3) {
            $data = User::join('pengajarans', 'users.username', '=', 'pengajarans.dosen_id')
                ->get();
        } else {
            $data = Pengajaran::where('dosen_id', $username)->get();
        }


        return view('pengajaran.index', compact('data', 'period'));
    }

    public function add()
    {
        $this->authorize('create', Pengajaran::class);

        $data = Periode::all();
        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('dosens.status', 'aktif')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('pengajaran.add', compact('data', 'dosen'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Pengajaran::class);

        $this->validate($request, [
            'kode_mk'   => 'required',
            'nama_mk'   => 'required',
            'kelas'     => 'required',
            'sks'       => 'required',
        ]);

        $data = Pengajaran::create([
            'dosen_id'   => $request->dosen_id,
            'periode_id' => $request->periode_id,
            'kode_mk'    => $request->kode_mk,
            'nama_mk'    => $request->nama_mk,
            'kelas'      => $request->kelas,
            'sks'        => $request->sks,
            'status_id'  => 1,
        ]);

        if ($data) {
            return redirect()->route('pengajaran.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengajaran $pengajaran)
    {
        $this->authorize('update', Pengajaran::class);

        $period = Periode::all();
        $status = Status::where('group', '=', 'pengajaran')->get();

        return view('pengajaran.edit', compact('pengajaran', 'period', 'status'));
    }

    public function update(Request $request, Pengajaran $pengajaran)
    {
        $this->authorize('update', Pengajaran::class);

        $pengajaran = Pengajaran::findOrFail($pengajaran->id);

        $pengajaran->update([
            'kode_mk'      => $request->kode_mk,
            'nama_mk'      => $request->nama_mk,
            'periode_id'   => $request->periode_id,
            'kelas'        => $request->kelas,
            'sks'          => $request->sks,
            'status_id'    => $request->status_id,
        ]);

        if ($pengajaran) {
            return redirect()->route('pengajaran.index')->with('success', 'Kode MK ' . $pengajaran["kode_mk"] . ' Updated successfully');
        }
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
}
