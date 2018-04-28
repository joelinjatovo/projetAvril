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
            'address' => "Ambohipo",
            'street' => "RN1",
            'suburb' => "",
            'state' => "",
            'region' => "Analamanga",
            'city' => "Antanarivo",
            'country' => "Madagascar",
            'locality' => "Antanarivo",
            'latitude' => "-18.8876785",
            'longitude' => '47.5125139',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "2",
            'address' => "Comté de Meekatharra",
            'street' => "",
            'suburb' => "",
            'state' => "Australie-Occidentale 6642",
            'region' => "",
            'city' => "Australie",
            'country' => "Australie",
            'locality' => "Shire of Meekatharra",
            'latitude' => "-25.792074",
            'longitude' => '118.967588',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "3",
            'address' => "Ex Wanna",
            'street' => "",
            'suburb' => "",
            'state' => "Western Australia",
            'region' => "Western Australia",
            'city' => "Australie",
            'country' => "Australie",
            'locality' => "Ex Wanna",
            'latitude' => "-23.775014",
            'longitude' => '116.810178',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "4",
            'address' => "Kumarina",
            'street' => "Australie-Occidentale 6642",
            'suburb' => "",
            'state' => "Western Australia",
            'region' => "Western Australia",
            'city' => "Australie",
            'country' => "Australie",
            'locality' => "Kumarina",
            'latitude' => "-24.832582",
            'longitude' => '119.161938',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "5",
            'address' => "Ilfracombe",
            'street' => "Queensland 4727",
            'suburb' => "",
            'state' => "Western Australia",
            'region' => "Western Australia",
            'city' => "Queensland",
            'country' => "Australie",
            'locality' => "Ilfracombe",
            'latitude' => "-23.800026",
            'longitude' => '144.381948',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('localizations')->insert([
            'id' => "6",
            'address' => "Blair Athol State Forest",
            'street' => "Clermont QLD 4721",
            'suburb' => "",
            'state' => "Western Australia",
            'region' => "Western Australia",
            'city' => "Queensland",
            'country' => "Australie",
            'locality' => "Blair Athol State Forest",
            'latitude' => "-22.697269",
            'longitude' => '147.426737',
            'author_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
