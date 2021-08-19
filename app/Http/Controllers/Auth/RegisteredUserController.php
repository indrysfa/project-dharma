<?php
/*
|--------------------------------------------------------------------------
| @author: Indry Sefviana | github @indrysfa
|--------------------------------------------------------------------------
*/
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jja;
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
        $jja = Jja::all();
        return view('auth.register', compact('jja'));
        // return view('auth.register', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jja_id'        => ['required', 'integer', 'max:7'],
            'kode'          => ['required', 'string', 'max:7'],
            'name'          => ['required', 'string', 'max:30'],
            'username'      => ['required', 'string', 'max:8', 'unique:users', 'alpha_dash'],
            'email'         => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'tmptlahir'     => ['required', 'string', 'max:50'],
            'tgl_lahir'     => ['required', 'string', 'max:30'],
            'no_telepon'    => ['required', 'string', 'max:13'],
            'alamat'        => ['required', 'string', 'max:60'],
        ]);

        // if ($request->role_id == 3) {
            $user = Dosen::create([
                'jja_id'        => strtolower($request->jja_id),
                'user_id'       => strtolower($request->username),
                'kode'          => $request->kode,
                'status'        => 'aktif',
                'name_dsn'      => ucwords($request->name),
                'email'         => $request->email,
                'tmptlahir'     => $request->tmptlahir,
                'tgl_lahir'     => $request->tgl_lahir,
                'no_telepon'    => $request->no_telepon,
                'alamat'        => ucwords($request->alamat),
            ]);
        // }

        $user = User::create([
            'role_id'       => 3,
            'name'          => ucwords($request->name),
            'username'      => strtolower($request->username),
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'tmptlahir'     => ucwords($request->tmptlahir),
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => ucwords($request->alamat),
            'status'        => 1,
        ]);

        event(new Registered($user));

        // Auth::login($user);
        Auth::routes(['verify' => true]);
        return redirect('verify-email');

        // return redirect(RouteServiceProvider::HOME);
    }
}
