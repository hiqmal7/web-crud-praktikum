<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan form registrasi.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran pengguna baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi input
        $request->validate([
            'npm'        => ['required', 'string', 'max:20', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Simpan data pengguna
        $user = User::create([
            'npm'        => $request->npm,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        // 3. Trigger event registrasi
        event(new Registered($user));

        // 4. Login otomatis
        Auth::login($user);

        // 5. Redirect ke dashboard
        return redirect()->route('dashboard');
    }
}