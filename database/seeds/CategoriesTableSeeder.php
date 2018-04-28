<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id' => "1",
            'slug' => "residentiel",
            'title' => "Residentiel",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('categories')->insert([
            'id' => "2",
            'slug' => "foncier",
            'title' => "Foncier",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('categories')->insert([
            'id' => "3",
            'slug' => "industriel",
            'title' => "Industriel",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('categories')->insert([
            'id' => "4",
            'slug' => "commercial",
            'title' => "Commercial",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('categories')->insert([
            'id' => "5",
            'slug' => "appartement",
            'title' => "Appartement",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('categories')->insert([
            'id' => "6",
            'slug' => "bureau",
            'title' => "Bureau",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('categories')->insert([
            'id' => "7",
            'slug' => "terrain",
            'title' => "Terrain",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
    }
}
