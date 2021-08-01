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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengajaranController extends Controller
{
    public function index()
    {
        // $data = Pengajaran::all();
        $user = Auth::user();
        // dd($user);
        if (Auth::user()->role_id === 1) {
            $data = Pengajaran::all();
        } else {
            $data = User::join('pengajarans', 'users.role_id', '=', 'pengajarans.dosen_id')
                ->where('dosen_id', '=', $user)
                ->get();
        }
        // $dosen = User::where('username', $userlogin);
        // dd($dosen);
        return view('pengajaran.index', compact('data'));
    }

    public function add()
    {
        $data = Periode::all();
        $dosen = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->orderBy('dosens.created_at', 'desc')
            ->get();
        return view('pengajaran.add', compact('data', 'dosen'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Dosen::class);

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
        ]);

        if ($data) {
            return redirect()->route('pengajaran.index')->with('success', 'Data added successfully');
        }
    }

    public function edit(Pengajaran $pengajaran)
    {
        $data = Periode::all();
        return view('pengajaran.edit', compact('pengajaran', 'data'));
    }

    public function update(Request $request, Pengajaran $pengajaran)
    {
        $pengajaran = Pengajaran::findOrFail($pengajaran->id);

        $pengajaran->update([
            'kode_mk'      => $request->kode_mk,
            'nama_mk'      => $request->nama_mk,
            'periode_id'   => $request->periode_id,
            'kelas'        => $request->kelas,
            'sks'          => $request->sks,
        ]);

        if ($pengajaran) {
            return redirect()->route('pengajaran.index')->with('success', 'Kode MK ' . $pengajaran["kode_mk"] . ' Updated successfully');
        }
    }

    public function destroy(Pengajaran $pengajaran)
    {
        $pengajaran->find($pengajaran->id)->all();

        $pengajaran->delete();

        if ($pengajaran) {
            return redirect()->route('pengajaran.index')->with('success', 'Kode MK ' . $pengajaran["kode_mk"] . ' deleted successfully');
        }
    }
}
