<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Menampilkan form pendaftaran.
     */
    public function showRegistrationForm()
    {
        // Di sini Anda bisa memuat StudyGroup dan data lain untuk form
        $studyGroups = \App\Models\StudyGroup::all();
        return view('auth.register', compact('studyGroups'));
    }

    /**
     * Menyimpan data user baru (Pendaftaran).
     */
    public function register(Request $request)
    {
        // 1. Validasi Data Pendaftaran
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['murid', 'guru'])], // Sesuaikan dengan Enum jika Anda menggunakannya
            'study_groups_id' => ['nullable', 'exists:study_groups,id'],
        ]);

        try {
            // 2. Buat User baru
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // WAJIB: Enkripsi password!
                'role' => $request->role,
                'study_groups_id' => $request->study_groups_id,
                // is_sarpras dan is_osis otomatis false (default di migration)
            ]);

            // 3. Langsung loginkan user setelah pendaftaran
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Selamat datang.');

        } catch (\Exception $e) {
            // Tangani error database jika ada
            return back()->withInput()->withErrors(['error' => 'Gagal mendaftar. Silakan coba lagi.']);
        }
    }

    /**
     * Menampilkan form Login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses permintaan login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Coba proses autentikasi
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Autentikasi berhasil
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Selamat datang kembali!');
        }

        // 3. Autentikasi gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}
