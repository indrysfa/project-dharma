<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input type="number" name="kode" value="888888" hidden>
            <!-- JJA -->
            <div class="mt-4">
                <x-label for="jja_id" :value="__('JJA')" />
                <select id="jja_id" class="block w-full mb-2" name="jja_id" :value="old('jja_id')">
                    <option value="">Select...</option>
                    @foreach ($jja as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
            </div>

            <!-- Username -->
            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" />
            </div>

            <!-- Role -->
            {{-- <div class="mt-4">
                <x-label for="role_id" :value="__('Role')" />
                <select id="role_id" class="block mt-1 w-full" name="role_id" :value="old('role_id')" required> --}}
            {{-- @foreach ($role as $item)
                        <option value="{{ $item->code }}">{{ $item->name }}</option>
                    @endforeach --}}
            {{-- <option value="3">Dosen</option> --}}
            {{-- <option value="lc">Language Center</option> --}}
            {{-- <option value="1">Admin</option> --}}
            {{-- </select>
            </div> --}}

            <!-- Tempat Lahir -->
            <div class="mt-4">
                <x-label for="tmptlahir" :value="__('Tempat Lahir')" />

                <x-input id="tmptlahir" class="block mt-1 w-full" type="text" name="tmptlahir" :value="old('tmptlahir')"
                    autofocus />
            </div>

            <!-- Tgl Lahir -->
            <div class="mt-4">
                <x-label for="tgl_lahir" :value="__('Tanggal Lahir')" />

                <x-input id="tgl_lahir" class="block mt-1 w-full" type="date" name="tgl_lahir" :value="old('tgl_lahir')"
                    autofocus />
            </div>

            <!-- No Telepon -->
            <div class="mt-4">
                <x-label for="no_telepon" :value="__('No Telepon')" />

                <x-input id="no_telepon" class="block mt-1 w-full" type="number" name="no_telepon"
                    :value="old('no_telepon')" autofocus />
            </div>

            <!-- Alamat -->
            <div class="mt-4">
                <x-label for="alamat" :value="__('Alamat')" />

                <x-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')"
                    autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
