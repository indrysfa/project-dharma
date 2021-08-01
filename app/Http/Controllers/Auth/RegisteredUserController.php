<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        // $role = Role::all();
        return view('auth.register');
        // return view('auth.register', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id'       => ['required', 'string', 'max:25'],
            'name'          => ['required', 'string', 'max:30'],
            'username'      => ['required', 'string', 'max:8', 'unique:users', 'alpha_dash'],
            'email'         => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'tmptlahir'     => ['required', 'string', 'max:50'],
            'tgl_lahir'     => ['required', 'string', 'max:30'],
            'no_telepon'    => ['required', 'string', 'max:13'],
            'alamat'        => ['required', 'string', 'max:60'],
        ]);

        if ($request->role_id == 3) {
            $user = Dosen::create([
                'user_id'       => strtolower($request->username),
                'status'        => 'aktif',
                'name'          => ucwords($request->name),
            ]);
        }

        $user = User::create([
            'role_id'       => $request->role_id,
            'name'          => ucwords($request->name),
            'username'      => strtolower($request->username),
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'tmptlahir'     => ucwords($request->tmptlahir),
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => ucwords($request->alamat),
        ]);

        event(new Registered($user));

        // Auth::login($user);
        Auth::routes(['verify' => true]);
        return redirect('verify-email');

        // return redirect(RouteServiceProvider::HOME);
    }
}
