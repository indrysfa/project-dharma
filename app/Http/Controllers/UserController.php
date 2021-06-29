<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('master.index', compact('data'));
    }

    public function dosen()
    {
        $dosen = DB::table('users')
            ->select('id', 'name', 'username', 'email', 'role', 'status')
            ->where('role', 'dosen')
            ->get();
        return view('master.dosen-index', compact('dosen'));
    }

    public function add()
    {
        return view('master.user-add');
    }

    public function create(Request $request)
    {
        $data = User::create([
            'name'          => ucwords($request->name),
            'username'      => strtolower($request->username),
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => $request->role,
            'tmptlahir'     => ucwords($request->tmptlahir),
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => ucwords($request->alamat),
            'status'        => 1
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
        return view('master.user-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

        $user->update([
            'name'          => ucwords($request->name),
            'username'      => strtolower($request->username),
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => $request->role,
            'tmptlahir'     => ucwords($request->tmptlahir),
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => ucwords($request->alamat),
            'status'        => 1
        ]);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'Data ' . $user["name"] . ' Updated successfully');
        }
    }

    public function destroy(User $user)
    {
        $user->find($user->id)->all();

        $user->delete();

        if ($user) {
            return redirect()->route('user.index')->with('success', 'Data ' . $user["name"] . ' deleted successfully');
        }
    }
}
