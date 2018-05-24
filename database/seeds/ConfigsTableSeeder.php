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
            'id' => 1,
            'name' => "site",
            'content' => "Parametre global du site web",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'id' => 2,
            'name' => "social_network",
            'content' => "Parametre des reseaux sociaux",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'id' => 3,
            'name' => "payment",
            'content' => "Parametre du paiement en ligne",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'id' => 4,
            'name' => "style",
            'content' => "Parametre de style CSS du site web",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'id' => 5,
            'name' => "login",
            'content' => "Parametre de login",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('configs')->insert([
            'id' => 6,
            'name' => "smtp",
            'content' => "Parametre de mail SMTP",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
    }
}
