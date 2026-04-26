<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterPoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_poli')->insert([
            ['name' => 'Poli Umum', 'code' => 'A'],
            ['name' => 'Poli Gigi', 'code' => 'B'],
            ['name' => 'KIA', 'code' => 'C'],
        ]);
    }
}
