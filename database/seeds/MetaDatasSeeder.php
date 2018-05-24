<?php

use Illuminate\Database\Seeder;

class MetaDatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meta_datas')->insert([
            'object_id' => 5, // Login Config
            'object_type' => "App\Models\Config",
            'key' => "title",
            'value' => serialize([
                'fr' => 'Connexion',
                'en' => 'Login'
            ]),
        ]);
        DB::table('meta_datas')->insert([
            'object_id' => 5, // Login Config
            'object_type' => "App\Models\Config",
            'key' => "content",
            'value' => serialize([
                'fr' => 'Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.',
                'en' => 'Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.'
            ]),
        ]);
        DB::table('meta_datas')->insert([
            'object_id' => 5, // Login Config
            'object_type' => "App\Models\Config",
            'key' => "contact",
            'value' => serialize([
                'fr' => '<ul><li>Téléphone: (123) 45678910</li><li>Mail: company@domain.com</li><li>Fax: +84 962 216 601</li></ul>',
                'en' => '<ul><li>Phone: (123) 45678910</li><li>Mail: company@domain.com</li><li>Fax: +84 962 216 601</li></ul>'
            ]),
        ]);
        DB::table('meta_datas')->insert([
            'object_id' => 5, // Login Config
            'object_type' => "App\Models\Config",
            'key' => "address",
            'value' => serialize([
                'fr' => '95 Amphitheatre Parkway<br>Mountain View CA,<br>United States',
                'en' => '95 Amphitheatre Parkway<br>Mountain View CA,<br>United States'
            ]),
        ]);
    }
}
