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
            'id' => 1,
            'title' => "Page d'accueil",
            'path' => '/',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        /*
        DB::table('pages')->insert([
            'id' => 2,
            'title' => "Listes des produits",
            'path' => '/products*',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        */
        DB::table('pages')->insert([
            'id' => 3,
            'title' => "Nos services",
            'path' => '/services',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        /*
        DB::table('pages')->insert([
            'id' => 4,
            'title' => "Inconnu",
            'path' => '/terms',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        */
        DB::table('pages')->insert([
            'id' => 5,
            'title' => "Publicites",
            'path' => '/pubs',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 6,
            'title' => "Termes et Conditions",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'path' => '/terms',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 7,
            'title' => "Confidentialites",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'path' => '/confidentialites',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 8,
            'title' => "Guide de l'investisseur",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'path' => '/help',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        
        // Home Page childs
        DB::table('pages')->insert([
            'id' => 9,
            'title' => "COMMUNAUTE FRANCOPHONE",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet.',
            'page_order' => '1',
            'parent_id' => '1',
            'path' => '/',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 10,
            'title' => "ESPACES PUBLICITES",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
labore et dolore magna aliquan ut enim ad minim veniam.',
            'page_order' => '2',
            'parent_id' => '1',
            'path' => '/',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 11,
            'title' => "COMMENT FONCTIONNE LE SITE INVESTIR EN AUSTRALIE",
            'content' => '<iframe src="https://www.youtube.com/embed/dzHw2RRyk68" allowfullscreen=""></iframe>',
            'page_order' => '3',
            'parent_id' => '1',
            'path' => '/',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 12,
            'title' => "NOTRE MISSION / NOTRE VISION",
            'content' => '<div class="row">
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="/images/features/1.png" alt="Feature Icon"></i>
                          <h6 class="">Etape 1</h6>
                          <p> Parmi tous les produits affichés sur le site. séléctionnez celui ou ceux qui vous interessent </p>
                      </div>
                  </div>
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="/images/features/2.png" alt="Feature Icon"></i>
                          <h6 class="">Etape 2</h6>
                          <p> Obtenez de l\'agence les informations que vous souhaitez sur le ou les biens séléctionnés </p>
                      </div>
                  </div>
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="/images/features/3.png" alt="Feature Icon"></i>
                          <h6 class="">Etape 3</h6>
                          <p> Après avoir fait votre choix, faites connaitre votre décision d\'achat à l\'agence francophone australienne chargée de la vente </p>
                      </div>
                  </div>
                  <div class="col-md-3 col-xs-6">
                      <div class="feature clearfix">
                          <i class="icon"><img src="/images/features/4.png" alt="Feature Icon"></i>
                          <h6 class="">Etape 4</h6>
                          <p> l\'agence phrancophone australienne se charge des formalités juridiquesde transfert de propriété </p>
                      </div>
                  </div>
              </div>
              <div style="text-align:justify">
                  <p> <label class="entry-title">Etape 1</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
                  <p> <label class="entry-title">Etape 2</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
                  <p> <label class="entry-title">Etape 3</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
                  <p> <label class="entry-title">Etape 4</label> : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. </p>
              </div>',
            'page_order' => '4',
            'parent_id' => '1',
            'path' => '/',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        
        // Nos services
        DB::table('pages')->insert([
            'id' => 13,
            'title' => "CONSEIL JURIDIQUE",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '1',
            'parent_id' => '3',
            'path' => '/services',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 14,
            'title' => "IMMIGRATION",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '2',
            'parent_id' => '3',
            'path' => '/',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 15,
            'title' => "Espaces Publicitaires",
            'content' => '<p class="wow slideInRight" style="visibility: hidden; animation-name: none;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>
                        labore et dolore magna aliquan ut enim ad minim veniam.</p>
                <a class="btn" href="#">
                    <img src="/images/iso-btn.png" alt="ISO Button">
                </a>
                <a class="btn" href="#">
                    <img src="/images/playstore-btn.png" alt="Play Store Button">
                </a>',
            'page_order' => '3',
            'parent_id' => '3',
            'path' => '/services',
            'is_pub' => '1',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 16,
            'title' => "CONSEIL FINANCIER ET BANCAIRE",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '4',
            'parent_id' => '3',
            'path' => '/services',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 17,
            'title' => "CONSEIL COMPTABLE ET FISCAL",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '5',
            'parent_id' => '3',
            'path' => '/services',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 18,
            'title' => "Espaces Publicitaires",
            'content' => '<p class="wow slideInRight" style="visibility: hidden; animation-name: none;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut <br>
                        labore et dolore magna aliquan ut enim ad minim veniam.</p>
                <a class="btn" href="#">
                    <img src="/images/iso-btn.png" alt="ISO Button">
                </a>
                <a class="btn" href="#">
                    <img src="/images/playstore-btn.png" alt="Play Store Button">
                </a>',
            'page_order' => '6',
            'parent_id' => '3',
            'path' => '/services',
            'is_pub' => '1',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 19,
            'title' => "AGENCE DE TRADUCTION ET INTERPRÉTARIAT",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '7',
            'parent_id' => '3',
            'path' => '/services',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 20,
            'title' => "AGENCE PARTENAIRE LOCAL",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '8',
            'parent_id' => '3',
            'path' => '/services',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 21,
            'title' => "CONSEIL EN ÉVALUATION D’AFFAIRES INDUSTRIELLES ET COMMERCIALES",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '9',
            'parent_id' => '3',
            'path' => '/services',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
