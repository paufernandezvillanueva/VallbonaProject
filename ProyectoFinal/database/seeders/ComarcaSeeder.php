<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('comarcas')->insert([
            'id' => 1,
            'name' => "Alt Camp",
        ]);
        DB::table('comarcas')->insert([
            'id' => 2,
            'name' => "Alt Empordà",
        ]);
        DB::table('comarcas')->insert([
            'id' => 3,
            'name' => "Alt Penedès",
        ]);
        DB::table('comarcas')->insert([
            'id' => 4,
            'name' => "Alt Urgell",
        ]);
        DB::table('comarcas')->insert([
            'id' => 5,
            'name' => "Alta Ribagorça",
        ]);
        DB::table('comarcas')->insert([
            'id' => 6,
            'name' => "Anoia",
        ]);
        DB::table('comarcas')->insert([
            'id' => 7,
            'name' => "Bages",
        ]);
        DB::table('comarcas')->insert([
            'id' => 8,
            'name' => "Baix Camp",
        ]);
        DB::table('comarcas')->insert([
            'id' => 9,
            'name' => "Baix Ebre",
        ]);
        DB::table('comarcas')->insert([
            'id' => 10,
            'name' => "Baix Empordà",
        ]);
        DB::table('comarcas')->insert([
            'id' => 11,
            'name' => "Baix Llobregat",
        ]);
        DB::table('comarcas')->insert([
            'id' => 12,
            'name' => "Baix Penedès",
        ]);
        DB::table('comarcas')->insert([
            'id' => 13,
            'name' => "Barcelonès",
        ]);
        DB::table('comarcas')->insert([
            'id' => 14,
            'name' => "Berguedà",
        ]);
        DB::table('comarcas')->insert([
            'id' => 15,
            'name' => "Cerdanya",
        ]);
        DB::table('comarcas')->insert([
            'id' => 16,
            'name' => "Conca de Barberà",
        ]);
        DB::table('comarcas')->insert([
            'id' => 17,
            'name' => "Garraf",
        ]);
        DB::table('comarcas')->insert([
            'id' => 18,
            'name' => "Garrigues",
        ]);
        DB::table('comarcas')->insert([
            'id' => 19,
            'name' => "Garrotxa",
        ]);
        DB::table('comarcas')->insert([
            'id' => 20,
            'name' => "Gironès",
        ]);
        DB::table('comarcas')->insert([
            'id' => 21,
            'name' => "Maresme",
        ]);
        DB::table('comarcas')->insert([
            'id' => 22,
            'name' => "Montsià",
        ]);
        DB::table('comarcas')->insert([
            'id' => 23,
            'name' => "Noguera",
        ]);
        DB::table('comarcas')->insert([
            'id' => 24,
            'name' => "Osona",
        ]);
        DB::table('comarcas')->insert([
            'id' => 25,
            'name' => "Pallars Jussà",
        ]);
        DB::table('comarcas')->insert([
            'id' => 26,
            'name' => "Pallars Sobirà",
        ]);
        DB::table('comarcas')->insert([
            'id' => 27,
            'name' => "Pla d'Urgell",
        ]);
        DB::table('comarcas')->insert([
            'id' => 28,
            'name' => "Pla de l'Estany",
        ]);
        DB::table('comarcas')->insert([
            'id' => 29,
            'name' => "Priorat",
        ]);
        DB::table('comarcas')->insert([
            'id' => 30,
            'name' => "Ribera d'Ebre",
        ]);
        DB::table('comarcas')->insert([
            'id' => 31,
            'name' => "Ripollès",
        ]);
        DB::table('comarcas')->insert([
            'id' => 32,
            'name' => "Segarra",
        ]);
        DB::table('comarcas')->insert([
            'id' => 33,
            'name' => "Segrià",
        ]);
        DB::table('comarcas')->insert([
            'id' => 34,
            'name' => "Selva",
        ]);
        DB::table('comarcas')->insert([
            'id' => 35,
            'name' => "Solsonès",
        ]);
        DB::table('comarcas')->insert([
            'id' => 36,
            'name' => "Tarragonès",
        ]);
        DB::table('comarcas')->insert([
            'id' => 37,
            'name' => "Terra Alta",
        ]);
        DB::table('comarcas')->insert([
            'id' => 38,
            'name' => "Urgell",
        ]);
        DB::table('comarcas')->insert([
            'id' => 39,
            'name' => "Aran",
        ]);
        DB::table('comarcas')->insert([
            'id' => 40,
            'name' => "Vallès Occidental",
        ]);
        DB::table('comarcas')->insert([
            'id' => 41,
            'name' => "Vallès Oriental",
        ]);
        DB::table('comarcas')->insert([
            'id' => 42,
            'name' => "Moianès",
        ]);
    }
}
