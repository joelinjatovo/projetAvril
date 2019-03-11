<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Blog;

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
        DB::table('categories')->insert([
            'id'         => "8",
            'slug'       => "actualites",
            'title'      => "Actualites",
            'type'       => "blog",
            'created_at' => date("Y-m-d H:i:s"),
            'author_id'  => 1,
        ]);
        
        $cats = [
            1 => [1, 2],
            2 => [3, 4],
            3 => [5, 6],
            4 => [7, 8],
        ];
        foreach($cats as $category => $objects){
            foreach($objects as $object){
                DB::table('objects_categories')->insert([
                    'category_id' => $category,
                    'object_id'   => $object,
                    'object_type' => Product::class,
                    'created_at'  => date("Y-m-d H:i:s"),
                    'author_id'   => 1,
                ]);
            }
        }
        
        $cats = [
            8 => [1, 2, 3, 4, 5],
        ];
        foreach($cats as $category => $objects){
            foreach($objects as $object){
                DB::table('objects_categories')->insert([
                    'category_id' => $category,
                    'object_id'   => $object,
                    'object_type' => Blog::class,
                    'created_at'  => date("Y-m-d H:i:s"),
                    'author_id'   => 1,
                ]);
            }
        }
    }
}
