<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedules')->insert([
            [
                'date' => '2025-10-09',
                'start_session' => '08:45',
                'end_session' => '15:00',
                'type' => 'KBM',
                'user_id' => 4,
                'room_id' => 3,
                'description' => 'XI RPL',
                'recurring' => true,
                'recurring_type' => 'pekanan',
                'status' => 'disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-14',
                'start_session' => '15:30',
                'end_session' => '17:00',
                'type' => 'Lainnya',
                'user_id' => 4,
                'room_id' => 4,
                'description' => 'ITC',
                'recurring' => true,
                'recurring_type' => 'pekanan',
                'status' => 'disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-10-20',
                'start_session' => '10:00',
                'end_session' => '15:00',
                'type' => 'Lainnya',
                'user_id' => 4,
                'room_id' => 2,
                'description' => 'MPK',
                'recurring' => false,
                'recurring_type' => null,
                'status' => 'disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
