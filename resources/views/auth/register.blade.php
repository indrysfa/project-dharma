@extends('auth.app')
@section('title', 'Register')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf

                                <input type="text" class="form-control" name="status" value="0" hidden>
                                {{-- Name --}}
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                        placeholder="Masukan Nama Lengkap">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Username --}}
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username') }}" required
                                        pattern="[a-zA-Z]+" autocomplete="
                                                                        username" autofocus placeholder="Masukan Username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                        placeholder="Masukan Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="password" name="password" required autocomplete="new-password"
                                            placeholder="Masukan Kata Sandi">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password-confirm"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Repeat Password">
                                    </div>
                                </div>

                                {{-- Role --}}
                                <div class="form-group">
                                    <select id="role" class="form-control form-control @error('role') is-invalid @enderror"
                                        name="role" value="{{ old('role') }}" required>
                                        <option value="dosen">Dosen</option>
                                        <option value="lc">Language Center</option>
                                        <option value="admin">Admin</option>
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Tempat Lahir --}}
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('tmptlahir') is-invalid @enderror"
                                        id="tmptlahir" name="tmptlahir" value="{{ old('tmptlahir') }}" required
                                        autocomplete="tmptlahir" autofocus placeholder="Masukan Tempat Lahir">

                                    @error('tmptlahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Tgl Lahir --}}
                                <div class="form-group">
                                    <input type="date"
                                        class="form-control form-control-user @error('tgl_lahir') is-invalid @enderror"
                                        id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required
                                        autocomplete="tgl_lahir" autofocus placeholder="Masukan Tanggal Lahir">

                                    @error('tgl_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- No Telepon --}}
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('no_telepon') is-invalid @enderror"
                                        id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required
                                        autocomplete="no_telepon" autofocus placeholder="Masukan No Telepon">

                                    @error('no_telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- Alamat --}}
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('alamat') is-invalid @enderror"
                                        id="alamat" name="alamat" value="{{ old('alamat') }}" required
                                        autocomplete="alamat" autofocus placeholder="Masukan Alamat">

                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
