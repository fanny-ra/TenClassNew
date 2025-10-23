<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            StudyGroupSeeder::class,
            UserSeeder::class,  // User dibuat, ID 1, 2, 3, 4, 5.
            RoomSeeder::class,  // Room dibuat, ID 1, 2, 3, 4.
            ScheduleSeeder::class, // <-- DIJALANKAN DI SINI
        ]);
    }
}
