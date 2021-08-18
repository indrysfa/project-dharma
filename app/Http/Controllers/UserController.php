<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jja;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('created_at', 'DESC')->get();
        return view('master.index', compact('data'));
    }

    public function add()
    {
        $this->authorize('create', User::class);

        $data = Role::all();
        $jja = Jja::all();
        return view('master.user-add', compact('data', 'jja'));
    }

    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        $this->validate($request, [
            'role_id'       => 'required|string|max:25',
            'name'          => 'required|string|max:30',
            'username'      => 'required|string|max:8|unique:users|alpha_dash',
            'email'         => 'required|string|email|max:50|unique:users',
            'password'      => 'required',
            'tmptlahir'     => 'required|string|max:50',
            'tgl_lahir'     => 'required|string|max:30',
            'no_telepon'    => 'required|string|max:13',
            'alamat'        => 'required|string|max:60',
            'picture'       => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $picture = $request->file('picture');
        $picture->storeAs('public/image', $picture->hashName());

        if ($request->role_id == 3) {
            $data = Dosen::create([
                'user_id'       => strtolower($request->username),
                'jja_id'        => $request->jja_id,
                'kode'          => 888888,
                'status'        => 'aktif',
                'name_dsn'      => ucwords($request->name),
                'email'         => $request->email,
                'tmptlahir'     => ucwords($request->tmptlahir),
                'tgl_lahir'     => $request->tgl_lahir,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => ucwords($request->alamat),
                'picture'       => $picture->hashName(),
            ]);
        }

        $data = User::create([
            'name'              => ucwords($request->name),
            'username'          => strtolower($request->username),
            'email'             => $request->email,
            'email_verified_at' => date("Y-m-d H:i:s"),
            'password'          => Hash::make($request->password),
            'role_id'           => $request->role_id,
            'tmptlahir'         => ucwords($request->tmptlahir),
            'tgl_lahir'         => $request->tgl_lahir,
            'no_telepon'        => $request->no_telepon,
            'alamat'            => ucwords($request->alamat),
            'picture'           => $picture->hashName(),
        ]);

        if ($data) {
            return redirect()->route('user.index')->with('success', 'Data added successfully');
        }
    }

    public function detail(User $user)
    {
        return view('master.user-detail', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', User::class);

        $role = Role::all();
        return view('master.user-edit', compact('user', 'role'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', User::class);

        $data = User::findOrFail($user->id);

        if ($request->file('picture') == "") {
            $data->update([
                'name'          => ucwords($request->name),
                'email'         => $request->email,
                'role'          => $request->role,
                'tmptlahir'     => ucwords($request->tmptlahir),
                'tgl_lahir'     => $request->tgl_lahir,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => ucwords($request->alamat),
            ]);

        } else {
            Storage::disk('local')->delete('public/image/' . $data->picture);
            $picture = $request->file('picture');
            $picture->storeAs('public/image', $picture->hashName());

            $data->update([
                'name'          => ucwords($request->name),
                'email'         => $request->email,
                'role'          => $request->role,
                'tmptlahir'     => ucwords($request->tmptlahir),
                'tgl_lahir'     => $request->tgl_lahir,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => ucwords($request->alamat),
                'picture'       => $picture->hashName()
            ]);
        }

        if ($data) {
            return redirect()->route('user.index')->with('success', 'Data updated successfully');
        }
    }

    public function destroy($id)
    {
        $this->authorize('delete', User::class);

        $param = User::findOrFail($id);

        if ($param->role_id == 3) {
            $user = Dosen::where('user_id', $param->username)->delete();
            $user = $param->delete();
        } else {
            $user = $param->delete();
        }
        Storage::disk('local')->delete('public/image/' . $param->picture);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'Data ' . $param->name . ' deleted successfully');
        }
    }
}
