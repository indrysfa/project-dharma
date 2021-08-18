<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        $role = Auth::user()->role;
        $status = Auth::user()->status;
        $user = Auth::user()->username;
        // $data =  User::first();

        // dd(Auth::user());


        switch ($status) {
            case 1:
                return '/admin';
                break;
            case 0:
                return '/register';
                break;
        }

        // switch ($role) {
        //     case 'admin':
        //         return '/admin';
        //         break;
        //     case 'lc':
        //         return '/lc';
        //         break;
        //     case 'dosen':
        //         return '/dosen';
        //         break;
        // }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => ['required', 'string', 'max:30'],
            'username'      => ['required', 'string', 'max:12', 'unique:users', 'alpha_dash'],
            'email_r'       => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'role'          => ['required', 'string', 'max:25'],
            'tmptlahir'     => ['required', 'string', 'max:50'],
            'tgl_lahir'     => ['required', 'string', 'max:30'],
            'no_telepon'    => ['required', 'string', 'max:13'],
            'alamat'        => ['required', 'string', 'max:60'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'          => ucwords($data['name']),
            'username'      => strtolower($data['username']),
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'role'          => $data['role'],
            'tmptlahir'     => ucwords($data['tmptlahir']),
            'tgl_lahir'     => $data['tgl_lahir'],
            'no_telepon'    => $data['no_telepon'],
            'alamat'        => ucwords($data['alamat']),
        ]);

        // $user->m_status_user()->attach(Status::where('code', 0)->first());

        return $user;
    }
}
