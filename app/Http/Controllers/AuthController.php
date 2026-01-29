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
    // 1. Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:murid,guru', // hanya murid atau guru
        'study_groups_id' => 'nullable|exists:study_groups,id',
    ]);

    try {
        // 2. Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_sarpras' => false,  // otomatis
            'is_osis' => false,     // otomatis
            'study_groups_id' => $request->study_groups_id ?? null,
        ]);

        // 3. Debug: cek data user
        // dd($user); // aktifkan kalau mau pastiin data terbentuk

        // 4. Auto-login
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Pendaftaran berhasil! Selamat datang.');

    } catch (\Exception $e) {
        // Tangani error
        return back()->withInput()->withErrors([
            'error' => 'Gagal mendaftar. Cek input atau hubungi admin.'
        ]);
    }
}



    /**
     * Menampilkan form Login.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Memproses permintaan login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'name' => ['required', 'string'],
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
            'name' => 'name atau password yang Anda masukkan salah.',
        ])->onlyInput('name');
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
