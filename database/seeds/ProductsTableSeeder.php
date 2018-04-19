<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => "1",
            'title' => "Residentiel",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "2",
            'title' => "Foncier",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "3",
            'title' => "Industriel",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "4",
            'title' => "Commercial",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id' => 1,
        ]);
    }
}
