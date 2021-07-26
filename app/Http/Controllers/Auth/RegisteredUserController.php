<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:30'],
            'username'      => ['required', 'string', 'max:8', 'unique:users', 'alpha_dash'],
            'email'         => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'role'          => ['required', 'string', 'max:25'],
            'tmptlahir'     => ['required', 'string', 'max:50'],
            'tgl_lahir'     => ['required', 'string', 'max:30'],
            'no_telepon'    => ['required', 'string', 'max:13'],
            'alamat'        => ['required', 'string', 'max:60'],
        ]);

        $user = User::create([
            'name'          => ucwords($request->name),
            'username'      => strtolower($request->username),
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => $request->role,
            'tmptlahir'     => ucwords($request->tmptlahir),
            'tgl_lahir'     => $request->tgl_lahir,
            'no_telepon'    => $request->no_telepon,
            'alamat'        => ucwords($request->alamat),
        ]);

        event(new Registered($user));

        // Auth::login($user);
        Auth::routes(['verify' => true]);

        // return redirect(RouteServiceProvider::HOME);
    }
}
