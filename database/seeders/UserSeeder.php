<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. ADMIN SARPRAS
        User::create([
            'name' => 'Nurtovingah',
            'email' => 'sarpras@sekolah.com', // <--- HARUS DITAMBAHKAN
            'email_verified_at' => now(), // Opsional, tapi bagus untuk kelengkapan
            'password' => Hash::make('sarpras123'),
            'role' => 'guru',
            'is_sarpras' => true,
            'is_osis' => false,
            'study_groups_id' => null,
            'remember_token' => Str::random(10),
        ]);

        // 2. Pembina OSIS (Role Guru, bukan Sarpras)
        User::create([
            'name' => 'Mujahid',
            'email' => 'mujahid.guru@sekolah.com', // <--- HARUS DITAMBAHKAN
            'email_verified_at' => now(),
            'password' => Hash::make('guru123'),
            'role' => 'guru',
            'is_sarpras' => false,
            'is_osis' => false,
            'study_groups_id' => null,
            'remember_token' => Str::random(10),
        ]);

        // 3. Ketua OSIS (Role Murid, is_osis TRUE)
        User::create([
            'name' => 'Husna',
            'email' => 'husna.osis@sekolah.com', // <--- HARUS DITAMBAHKAN
            'email_verified_at' => now(),
            'password' => Hash::make('osis123'),
            'role' => 'murid',
            'is_sarpras' => false,
            'is_osis' => true,
            'study_groups_id' => null,
            'remember_token' => Str::random(10),
        ]);

        // 4. Murid Biasa (Peminjam)
        User::create([
            'name' => 'Apip (Murid Biasa)',
            'email' => 'apip@sekolah.com', // <--- HARUS DITAMBAHKAN
            'email_verified_at' => now(),
            'password' => Hash::make('murid123'),
            'role' => 'murid',
            'is_sarpras' => false,
            'is_osis' => false,
            'study_groups_id' => null,
            'remember_token' => Str::random(10),
        ]);
    }
}
