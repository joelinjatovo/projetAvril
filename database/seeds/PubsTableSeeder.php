<?php

use Illuminate\Database\Seeder;

class PubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pubs')->insert([
            'id' => "1",
            'title' => "CocaCola",
            'content' => 'Pub du cocacola',
            'links' => 'https://www.youtube.com',
            'created_at' => date("Y-m-d H:i:s"),
            'image_id' => 0,
            'author_id' => 1,
        ]);
        DB::table('pubs')->insert([
            'id' => "2",
            'title' => "THB",
            'content' => 'Pub du THB',
            'links' => 'https://www.facebook.com',
            'created_at' => date("Y-m-d H:i:s"),
            'image_id' => 0,
            'author_id' => 1,
        ]);
        DB::table('pubs')->insert([
            'id' => "3",
            'title' => "Adidas",
            'content' => 'Pub du adidas',
            'links' => 'https://www.adidas.com',
            'created_at' => date("Y-m-d H:i:s"),
            'image_id' => 0,
            'author_id' => 1,
        ]);
    }
}
