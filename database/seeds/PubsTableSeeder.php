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
            'image_id' => 21,
            'author_id' => 1,
        ]);
        DB::table('pubs')->insert([
            'id' => "2",
            'title' => "THB",
            'content' => 'Pub du THB',
            'links' => 'https://www.facebook.com',
            'created_at' => date("Y-m-d H:i:s"),
            'image_id' => 22,
            'author_id' => 1,
        ]);
        DB::table('pubs')->insert([
            'id' => "3",
            'title' => "Peugeot",
            'content' => 'Pub du Peugeot',
            'links' => 'https://www.peugeot.com',
            'created_at' => date("Y-m-d H:i:s"),
            'image_id' => 23,
            'author_id' => 1,
        ]);
        DB::table('pubs')->insert([
            'id' => "4",
            'title' => "iNet",
            'content' => 'Pub du iNEt',
            'links' => 'https://www.adidas.com',
            'created_at' => date("Y-m-d H:i:s"),
            'image_id' => 24,
            'author_id' => 1,
        ]);
    }
}
