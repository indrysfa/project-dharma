<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('master.index', compact('data'));
    }

    public function add()
    {
        return view('master.user-add');
    }

    public function create(Request $request)
    {
        $data = User::create([
            'name'          => $request->name,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => $request->password,
            'role'          => $request->role,
            'tmptlahir'     => $request->tmptlahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => $request->alamat
        ]);

        if ($data) {
            return redirect()->route('user.index');
        }
    }

    public function destroy(User $user)
    {
        $user->find($user->id)->all();

        $user->delete();

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User deleted successfully');
        }
    }
}
