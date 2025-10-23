<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            ['name' => 'RT 4', 'capacity' => 40, 'type' => 'teori', 'shielded' => false],
            ['name' => 'Aula', 'capacity' => 150, 'type' => 'aula', 'shielded' => true],
            ['name' => 'LAB RPL', 'capacity' => 40, 'type' => 'lab', 'shielded' => true],
            ['name' => 'RT 1', 'capacity' => 40, 'type' => 'teori', 'shielded' => false],
        ]);
    }
}
