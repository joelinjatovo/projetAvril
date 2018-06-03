<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1-7: product
        for($i=1; $i<8;$i++){
            DB::table('images')->insert([
                'url' => "",
                'filename' => $i.".jpg",
                'filepath' => "product/".$i.".jpg",
                'filemime' => "image/jpg",
                'author_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
        //8-10: blog
        for($i=1; $i<4;$i++){
            DB::table('images')->insert([
                'url' => "",
                'filename' => $i.".jpg",
                'filepath' => "blog/".$i.".jpg",
                'filemime' => "image/jpg",
                'author_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
        //11-12: carousel
        for($i=1; $i<4;$i++){
            DB::table('images')->insert([
                'url' => "",
                'filename' => $i.".jpg",
                'filepath' => "carousel/".$i.".jpg",
                'filemime' => "image/jpg",
                'author_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
        //13-20: slider
        for($i=1; $i<8;$i++){
            DB::table('images')->insert([
                'url' => "",
                'filename' => $i.".jpg",
                'filepath' => "slider/".$i.".jpg",
                'filemime' => "image/jpg",
                'author_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
        //21-24: pub
        for($i=1; $i<5;$i++){
            DB::table('images')->insert([
                'url' => "",
                'filename' => $i.".jpg",
                'filepath' => "pub/".$i.".jpg",
                'filemime' => "image/jpg",
                'author_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
        //25-33: property
        for($i=1; $i<5;$i++){
            DB::table('images')->insert([
                'url' => "",
                'filename' => $i.".jpg",
                'filepath' => "property/".$i.".jpg",
                'filemime' => "image/jpg",
                'author_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
