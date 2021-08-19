<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jja;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Pengajaran;
use App\Models\Pengembangan;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorize('aktif', User::class);
    // }

    public function index()
    {
        $this->authorize('view', Dosen::class);

        $user = Auth::user()->username;
        if (Auth::user()->role_id !== 3) {
            $data = Dosen::orderBy('created_at', 'desc')->get();
        } else {
            $dosen = Dosen::where('user_id', '=', $user)
                ->orderBy('created_at', 'asc')
                ->get();
            $data = Dosen::where('id', $dosen[0]->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }
        return view('master.dosen-index', compact('data'));
    }

    public function add()
    {
        $this->authorize('create', Dosen::class);

        $data = Periode::all();
        return view('master.dosen-add', compact('data'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', Dosen::class);

        $this->validate($request, [
            'jja_id'        => ['required', 'string', 'max:7'],
            'user_id'       => ['required', 'string', 'max:12', 'unique:dosens', 'alpha_dash'],
            'kode'          => ['required', 'string', 'max:7'],
            'name_dsn'      => ['required', 'string', 'max:30'],
            'tmptlahir'     => ['required', 'string', 'max:50'],
            'tgl_lahir'     => ['required', 'string', 'max:30'],
            'email'         => ['required', 'string', 'max:50', 'email', 'unique:users'],
            'no_telepon'    => ['required', 'integer', 'max:13'],
            'alamat'        => ['required', 'string', 'max:60'],
            'picture'        => ['required', 'image', 'mimes:png,jpg,jpeg'],
        ]);

        $data = Dosen::create([
            'jja_id'        => $request->jja_id,
            'user_id'       => $request->user_id,
            'kode'          => $request->kode,
            'name_dsn'      => ucwords($request->name_dsn),
            'tmptlahir'     => ucwords($request->tgl_lahir),
            'tgl_lahir'     => $request->tgl_lahir,
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => $request->alamat,
            'picture'       => $request->picture,
            'status'        => 'aktif',
        ]);

        if ($data) {
            return redirect()->route('dosen.index')->with('success', 'Data added successfully');
        }
    }

    public function detail(Dosen $dosen)
    {
        $this->authorize('view', Dosen::class);

        $dosens = $dosen->find($dosen->id)->all();
        // dd($dosens);
        $year = date("Y");
        $pengajaran = Pengajaran::orderBy('pengajarans.created_at', 'desc')
            ->join('dosens', 'pengajarans.dosen_id', '=', 'dosens.id')
            ->join('periodes', 'pengajarans.periode_id', '=', 'periodes.id')
            ->where('dosens.id', '=', $dosens[0]->id)
            ->where('periodes.tahun', '=', $year)
            ->get();
        $penelitian = Penelitian::orderBy('penelitians.created_at', 'desc')
            ->join('dosens', 'penelitians.dosen_id', '=', 'dosens.id')
            ->join('periodes', 'penelitians.periode_id', '=', 'periodes.id')
            ->where('dosens.id', '=', $dosens[0]->id)
            ->where('periodes.tahun', '=', $year)
            ->get();
        $pengabdian = Pengabdian::orderBy('pengabdians.created_at', 'desc')
            ->join('dosens', 'pengabdians.dosen_id', '=', 'dosens.id')
            ->join('periodes', 'pengabdians.periode_id', '=', 'periodes.id')
            ->where('dosens.id', '=', $dosens[0]->id)
            ->where('periodes.tahun', '=', $year)
            ->get();
        $pengembangan = Pengembangan::orderBy('pengembangans.created_at', 'desc')
            ->join('dosens', 'pengembangans.dosen_id', '=', 'dosens.id')
            ->join('periodes', 'pengembangans.periode_id', '=', 'periodes.id')
            ->where('dosens.id', '=', $dosens[0]->id)
            ->where('periodes.tahun', '=', $year)
            ->get();
        return view('master.dosen-detail', compact('dosen', 'pengajaran', 'penelitian', 'pengabdian', 'pengembangan'));
    }

    public function edit(Dosen $dosen)
    {
        $this->authorize('update', Dosen::class);

        $data = User::join('dosens', 'users.username', '=', 'dosens.user_id')
            ->where('username', '=', $dosen->user_id)
            ->get();
            // dd($data);
        $jja = Jja::all();
        return view('master.dosen-edit', compact('data', 'jja'));
    }

    public function update(Request $request, Dosen $dosen, User $user)
    {
        $this->authorize('update', Dosen::class);

        $dosen  = Dosen::findOrFail($dosen->id);
        $user = User::where('username', $dosen->user_id)->first();
        // dd($user);

        if ($request->file('picture') == "") {
            $dosen->update([
                'jja_id'        => $request->jja_id,
                'user_id'       => $request->user_id,
                'kode'          => $request->kode,
                'name_dsn'      => ucwords($request->name_dsn),
                'tmptlahir'     => ucwords($request->tmptlahir),
                'tgl_lahir'     => $request->tgl_lahir,
                'email'         => $request->email,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => $request->alamat,
                'status'        => 'aktif',
            ]);

            $user->update([
                'name'          => ucwords($request->name_dsn),
                'email'         => $request->email,
                'role'          => $request->role,
                'tmptlahir'     => ucwords($request->tmptlahir),
                'tgl_lahir'     => $request->tgl_lahir,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => ucwords($request->alamat),
            ]);

        } else {
            Storage::disk('local')->delete('public/image/' . $dosen->picture);
            Storage::disk('local')->delete('public/image/' . $user->picture);
            $picture = $request->file('picture');
            $picture->storeAs('public/image', $picture->hashName());

            $dosen->update([
                'jja_id'        => $request->jja_id,
                'user_id'       => $request->user_id,
                'kode'          => $request->kode,
                'name_dsn'      => ucwords($request->name_dsn),
                'tmptlahir'     => ucwords($request->tmptlahir),
                'tgl_lahir'     => $request->tgl_lahir,
                'email'         => $request->email,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => $request->alamat,
                'status'        => 'aktif',
                'picture'       => $picture->hashName()
            ]);

            $user->update([
                'name'          => ucwords($request->name_dsn),
                'email'         => $request->email,
                'role'          => $request->role,
                'tmptlahir'     => ucwords($request->tmptlahir),
                'tgl_lahir'     => $request->tgl_lahir,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => ucwords($request->alamat),
                'picture'       => $picture->hashName()
            ]);
        }

        if ($dosen) {
            return redirect()->route('dosen.index')->with('success', 'Data ' . $dosen["name"] . ' Updated successfully');
        }
    }

    public function destroyv1(Dosen $dos)
    {
        // $this->authorize('delete', Dosen::class);
        // $dos->find($dos->id)->first();
        // $dos->delete();
        $dosens = User::join('dosens', 'users.username', '=', $dos->username)->get();
        // $dosens = User::where('username', $dos->username)->get();
        dd($dosens);
        // $data = Dosen::all();
        $data = User::join('dosens', 'users.username', '=', $dos->user_id)->get();
        // $dosen->delete();

        // $data = User::join('dosens', 'users.username', '=', $dos->user_id)->get();
        foreach ($data as $dosen) {
            // DB::table('dosens')->where('user_id', $dos->username)->delete();
            DB::table('users')->where('username', $dosen->user_id)->delete();
        }

        if ($dosen) {
            return redirect()->route('dosen.index')->with('success', 'Data ' . $dosen["name"] . ' deleted successfully');
        }
    }

    public function destroy(Dosen $dosen)
    {
        $this->authorize('delete', Dosen::class);

        $dosen->find($dosen->id)->all();

        $data = User::join('dosens', 'users.username', '=', $dosen->user_id)->get();
        foreach ($data as $dos) {
            // DB::table('dosens')->where('user_id', $dos->username)->delete();
            DB::table('users')->where('username', $dos->user_id)->delete();
            $dosen->delete();
        }

        if ($dosen) {
            return redirect()->route('dosen.index')->with('success', 'Kode MK ' . $dosen["name"] . ' deleted successfully');
        }
    }
}
