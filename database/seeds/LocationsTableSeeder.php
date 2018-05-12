<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('localizations')->insert([
            'id' => "1",
            'formatted' => "Ambohipo",
            'country' => "Madagascar",
            'area_level_1' => "Antanarivo",
            'area_level_2' => "Analamanga",
            'route' => "",
            'postalCode' => "",
            'locality' => "Antanarivo",
            'latitude' => "-18.8876785",
            'longitude' => '47.5125139',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "2",
            'formatted' => "Comté de Meekatharra",
            'country' => "Australie",
            'area_level_1' => "Australie-Occidentale 6642",
            'area_level_2' => "Shire of Meekatharra",
            'locality' => "Australie",
            'latitude' => "-25.792074",
            'longitude' => '118.967588',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "3",
            'formatted' => "Ex Wanna",
            'area_level_1' => "Western Australia",
            'area_level_2' => "Western Australia",
            'locality' => "Australie",
            'country' => "Australie",
            'locality' => "Ex Wanna",
            'latitude' => "-23.775014",
            'longitude' => '116.810178',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "4",
            'formatted' => "Kumarina",
            'route' => "Australie-Occidentale 6642",
            'area_level_1' => "Western Australia",
            'area_level_2' => "Western Australia",
            'country' => "Australie",
            'locality' => "Kumarina",
            'latitude' => "-24.832582",
            'longitude' => '119.161938',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "5",
            'formatted' => "Ilfracombe",
            'area_level_1' => "Queensland 4727",
            'area_level_2' => "Western Australia",
            'country' => "Australie",
            'locality' => "Ilfracombe",
            'latitude' => "-23.800026",
            'longitude' => '144.381948',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "6",
            'formatted' => "Blair Athol State Forest",
            'route' => "Clermont QLD 4721",
            'area_level_1' => "Western Australia",
            'area_level_2' => "Western Australia",
            'country' => "Australie",
            'locality' => "Blair Athol State Forest",
            'latitude' => "-22.697269",
            'longitude' => '147.426737',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
