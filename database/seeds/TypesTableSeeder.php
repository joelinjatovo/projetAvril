<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'id' => "1",
            'slug' => "appartement",
            'title' => "Appartement",
            'object_type' => "type",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "2",
            'slug' => "maison-individuelle",
            'title' => "Maison Individuelle",
            'object_type' => "type",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "3",
            'slug' => "town-ville",
            'title' => "Maison En Ville",
            'object_type' => "type",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "4",
            'slug' => "terrain",
            'title' => "Terrain",
            'object_type' => "type",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "5",
            'slug' => "bureau-local-commercial",
            'title' => "Bureau & Local Commercial",
            'object_type' => "type",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "6",
            'slug' => "entrepot-local-activite",
            'title' => "Entrepot & Local Activité",
            'object_type' => "type",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "7",
            'slug' => "en-agglomeration",
            'title' => "En Agglomération",
            'object_type' => "location",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "8",
            'slug' => "hors-agglomeration",
            'title' => "Hors Agglomération",
            'object_type' => "location",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('types')->insert([
            'id' => "9",
            'slug' => "en-campagne",
            'title' => "En Campagne",
            'object_type' => "location",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
    }
}
