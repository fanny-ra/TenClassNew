<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            'X RPL', 'X MP', 'X Mlog', 'X AK 1', 'X AK 2', 'X BR', 'X BD',
            'XI RPL', 'XI MP', 'XI Mlog', 'XI AK 1', 'XI AK 2', 'XI BR', 'XI BD',
            'XII RPL', 'XII MP', 'XII Mlog', 'XII AK 1', 'XII AK 2', 'XII BR', 'XII BD'
        ];

        foreach ($groups as $name) {
            DB::table('study_groups')->insert(['name' => $name, 'created_at' => now(), 'updated_at' => now()]);
        }
    }
}
