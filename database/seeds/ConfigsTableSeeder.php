<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
            'name' => "site",
            'content' => "Parametre global du site web",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'name' => "social_network",
            'content' => "Parametre des reseaux sociaux",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'name' => "currency",
            'content' => "Parametre du paiement en ligne",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'name' => "style",
            'content' => "Parametre de style CSS du site web",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
    }
}
