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
        DB::table('comarques')->insert([
            'id' => 1,
            'name' => "Alt Camp",
        ]);
        DB::table('comarques')->insert([
            'id' => 2,
            'name' => "Alt Empordà",
        ]);
        DB::table('comarques')->insert([
            'id' => 3,
            'name' => "Alt Penedès",
        ]);
        DB::table('comarques')->insert([
            'id' => 4,
            'name' => "Alt Urgell",
        ]);
        DB::table('comarques')->insert([
            'id' => 5,
            'name' => "Alta Ribagorça",
        ]);
        DB::table('comarques')->insert([
            'id' => 6,
            'name' => "Anoia",
        ]);
        DB::table('comarques')->insert([
            'id' => 7,
            'name' => "Bages",
        ]);
        DB::table('comarques')->insert([
            'id' => 8,
            'name' => "Baix Camp",
        ]);
        DB::table('comarques')->insert([
            'id' => 9,
            'name' => "Baix Ebre",
        ]);
        DB::table('comarques')->insert([
            'id' => 10,
            'name' => "Baix Empordà",
        ]);
        DB::table('comarques')->insert([
            'id' => 11,
            'name' => "Baix Llobregat",
        ]);
        DB::table('comarques')->insert([
            'id' => 12,
            'name' => "Baix Penedès",
        ]);
        DB::table('comarques')->insert([
            'id' => 13,
            'name' => "Barcelonès",
        ]);
        DB::table('comarques')->insert([
            'id' => 14,
            'name' => "Berguedà",
        ]);
        DB::table('comarques')->insert([
            'id' => 15,
            'name' => "Cerdanya",
        ]);
        DB::table('comarques')->insert([
            'id' => 16,
            'name' => "Conca de Barberà",
        ]);
        DB::table('comarques')->insert([
            'id' => 17,
            'name' => "Garraf",
        ]);
        DB::table('comarques')->insert([
            'id' => 18,
            'name' => "Garrigues",
        ]);
        DB::table('comarques')->insert([
            'id' => 19,
            'name' => "Garrotxa",
        ]);
        DB::table('comarques')->insert([
            'id' => 20,
            'name' => "Gironès",
        ]);
        DB::table('comarques')->insert([
            'id' => 21,
            'name' => "Maresme",
        ]);
        DB::table('comarques')->insert([
            'id' => 22,
            'name' => "Montsià",
        ]);
        DB::table('comarques')->insert([
            'id' => 23,
            'name' => "Noguera",
        ]);
        DB::table('comarques')->insert([
            'id' => 24,
            'name' => "Osona",
        ]);
        DB::table('comarques')->insert([
            'id' => 25,
            'name' => "Pallars Jussà",
        ]);
        DB::table('comarques')->insert([
            'id' => 26,
            'name' => "Pallars Sobirà",
        ]);
        DB::table('comarques')->insert([
            'id' => 27,
            'name' => "Pla d'Urgell",
        ]);
        DB::table('comarques')->insert([
            'id' => 28,
            'name' => "Pla de l'Estany",
        ]);
        DB::table('comarques')->insert([
            'id' => 29,
            'name' => "Priorat",
        ]);
        DB::table('comarques')->insert([
            'id' => 30,
            'name' => "Ribera d'Ebre",
        ]);
        DB::table('comarques')->insert([
            'id' => 31,
            'name' => "Ripollès",
        ]);
        DB::table('comarques')->insert([
            'id' => 32,
            'name' => "Segarra",
        ]);
        DB::table('comarques')->insert([
            'id' => 33,
            'name' => "Segrià",
        ]);
        DB::table('comarques')->insert([
            'id' => 34,
            'name' => "Selva",
        ]);
        DB::table('comarques')->insert([
            'id' => 35,
            'name' => "Solsonès",
        ]);
        DB::table('comarques')->insert([
            'id' => 36,
            'name' => "Tarragonès",
        ]);
        DB::table('comarques')->insert([
            'id' => 37,
            'name' => "Terra Alta",
        ]);
        DB::table('comarques')->insert([
            'id' => 38,
            'name' => "Urgell",
        ]);
        DB::table('comarques')->insert([
            'id' => 39,
            'name' => "Aran",
        ]);
        DB::table('comarques')->insert([
            'id' => 40,
            'name' => "Vallès Occidental",
        ]);
        DB::table('comarques')->insert([
            'id' => 41,
            'name' => "Vallès Oriental",
        ]);
        DB::table('comarques')->insert([
            'id' => 42,
            'name' => "Moianès",
        ]);
    }
}
