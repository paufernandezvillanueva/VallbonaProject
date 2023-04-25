<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('rols')->insert([
            'name' => "Standard",
        ]);
        DB::table('rols')->insert([
            'id' => 5076,
            'name' => "Admin",
        ]);
    }
}
