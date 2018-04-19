<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'title' => "Page d'accueil",
            'path' => '/',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => "Listes des produits",
            'path' => '/products*',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => "Nos services",
            'path' => '/services',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => "Listes des articles",
            'path' => '/blogs*',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => "Visualisation d'un article",
            'path' => '/blog/*',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => "Termes et Conditions",
            'path' => '/terms',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => "Confidentialites",
            'path' => '/confidentialites',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => "Guide de l'investisseur",
            'path' => '/help',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
