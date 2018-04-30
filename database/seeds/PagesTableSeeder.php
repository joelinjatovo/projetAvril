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
        DB::table('pages')->insert([
            'id' => 3,
            'title' => "Nos services",
            'path' => '/services',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
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
            'path' => '/1',
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
            'path' => '/2',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 11,
            'title' => "COMMENT FONCTIONNE LE SITE INVESTIR EN AUSTRALIE",
            'content' => '<iframe src="https://www.youtube.com/embed/dzHw2RRyk68" allowfullscreen=""></iframe>',
            'page_order' => '3',
            'parent_id' => '1',
            'path' => '/3',
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
            'path' => '/4',
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
            'path' => '/services/1',
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
            'path' => '/services/2',
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
            'path' => '/services/3',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 17,
            'title' => "CONSEIL COMPTABLE ET FISCAL",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '5',
            'parent_id' => '3',
            'path' => '/services/4',
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
            'path' => '/services/5',
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
            'path' => '/services/6',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 20,
            'title' => "AGENCE PARTENAIRE LOCAL",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '8',
            'parent_id' => '3',
            'path' => '/services/7',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 21,
            'title' => "CONSEIL EN ÉVALUATION D’AFFAIRES INDUSTRIELLES ET COMMERCIALES",
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
            'page_order' => '9',
            'parent_id' => '3',
            'path' => '/services/8',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 22,
            'title' => "Connexion",
            'content' => 'Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.',
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/login',
            'language' => 'fr',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 23,
            'title' => "Login",
            'content' => '
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-map-marker"></i>
                                <div class="contents">
                                    <h6 class="title">Mailing Address</h6>
                                    <address>
                                        95 Amphitheatre Parkway
                                        Mountain View CA,
                                        United States
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-phone"></i>
                                <div class="contents">
                                    <h5 class="title">Contact Info</h5>
                                    <ul>
                                        <li>Phone: (123) 45678910</li>
                                        <li>Mail: company@domain.com</li>
                                        <li>Fax: +84 962 216 601</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
',
            'page_order' => '0',
            'parent_id' => '22',
            'path' => '/login/1',
            'language' => 'fr',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 24,
            'title' => "Login",
            'content' => 'Sed perspiciatis unde natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.',
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/login',
            'language' => 'en',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 25,
            'title' => "Login",
            'content' => '
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fa fa-map-marker"></i>
                                <div class="contents">
                                    <h6 class="title">Mailing Address</h6>
                                    <address>
                                        95 Amphitheatre Parkway
                                        Mountain View CA,
                                        United States
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-phone"></i>
                                <div class="contents">
                                    <h5 class="title">Contact Info</h5>
                                    <ul>
                                        <li>Phone: (123) 45678910</li>
                                        <li>Mail: company@domain.com</li>
                                        <li>Fax: +84 962 216 601</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
',
            'page_order' => '0',
            'parent_id' => '22',
            'path' => '/login/1',
            'language' => 'en',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 26,
            'title' => "Message d'information",
            'content' => "Merci de votre intention de vous inscrire en qualité de Membre sur le site \"Investir en Australie\". En plus de pouvoir, comme tout Visiteur, voir dans le détail les produits et opérer des sélections multicritères, votre inscription vous permettra d'enregistrer vos recherches multicritères, d'enregistrer les produits qui vous intéressent dans vos \"favoris\", de partager des produits avec vos amis par emails et sur les réseaux sociaux, d'échanger avec une Agence Francophone Australienne située à proximité du bien qui vous intéresse. Lorsque vous aurez pris la décision d'acheter vous pourrez lancer la procédure d'acquisition en ligne. Au cours de cette procédure il vous sera proposé les services de certains de nos partenaires australiens francophones auxquels vous pourriez faire appel si vous en aviez besoin.",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/member',
            'language' => 'fr',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 27,
            'title' => "Message d'information",
            'content' => "Merci de votre intention de vous inscrire en qualité de Membre sur le site \"Investir en Australie\". En plus de pouvoir, comme tout Visiteur, voir dans le détail les produits et opérer des sélections multicritères, votre inscription vous permettra d'enregistrer vos recherches multicritères, d'enregistrer les produits qui vous intéressent dans vos \"favoris\", de partager des produits avec vos amis par emails et sur les réseaux sociaux, d'échanger avec une Agence Francophone Australienne située à proximité du bien qui vous intéresse. Lorsque vous aurez pris la décision d'acheter vous pourrez lancer la procédure d'acquisition en ligne. Au cours de cette procédure il vous sera proposé les services de certains de nos partenaires australiens francophones auxquels vous pourriez faire appel si vous en aviez besoin.",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/member',
            'language' => 'en',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 28,
            'title' => "Explanation message",
            'content' => "The Seller must accept The Terms and Conditions of Use of \"Investir en Australie\" website and make the commitment to display only products that can be sold to non-resident foreigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/seller',
            'language' => 'en',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 29,
            'title' => "Explanation message",
            'content' => "The Seller must accept The Terms and Conditions of Use of \"Investir en Australie\" website and make the commitment to display only products that can be sold to non-resident foreigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/seller',
            'language' => 'fr',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 30,
            'title' => "Explanation message",
            'content' => "The Australian Francophone Agents are Australian agents who are partners with \"Investir en Australie\" website. They are the essential link in the material realization of the sale of the products posted on the site, but they can also sell their own products.The Australian Francophone Agent must make the commitment to provide prospective or actual purchasers with a service in French during preliminary sales and during sales transactions. They must also accept that a clientele introductory fee (\"Commission de Présentation de Clientèle\" - CPC) will be due to the company managing IEA website in case of actual sale of products, accept and respect the Terms and Conditions of Use of the site, and make the commitment to verify and guarantee that the products for the sale of which they are the operating agent are effectively residential, land, industrial or commercial properties which may be sold to non-resident foreigners in accordance with the Australian law and the rules applicable to foreign investment by the Foreign Investment Review Board (FIRB).",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/afa',
            'language' => 'en',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 31,
            'title' => "Explanation message",
            'content' => "The Australian Francophone Agents are Australian agents who are partners with \"Investir en Australie\" website. They are the essential link in the material realization of the sale of the products posted on the site, but they can also sell their own products.The Australian Francophone Agent must make the commitment to provide prospective or actual purchasers with a service in French during preliminary sales and during sales transactions. They must also accept that a clientele introductory fee (\"Commission de Présentation de Clientèle\" - CPC) will be due to the company managing IEA website in case of actual sale of products, accept and respect the Terms and Conditions of Use of the site, and make the commitment to verify and guarantee that the products for the sale of which they are the operating agent are effectively residential, land, industrial or commercial properties which may be sold to non-resident foreigners in accordance with the Australian law and the rules applicable to foreign investment by the Foreign Investment Review Board (FIRB).",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/afa',
            'language' => 'fr',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 32,
            'title' => "Message d'information",
            'content' => "Les Agences Partenaires Locales (APL) sont des agences immobilières et d'affaires opérant dans des pays et territoires francophones qui souhaitent participer au courant d'investissement que développe le projet \"Investir en Australie\" (IEA). Dans ce cadre, l'APL est chargée d'une Mission d'Information, d'Orientation et de Promotion (MIOP) en direction des Membres du site IEA. Les Membres qui souhaitent une assistance locale pour leur démarche d'investissement en Australie souscrivent une relation exclusive de 180 jours avec une APL près de chez eux. En cas d'achat par le Membre inscrit auprès d'une APL, celle-ci perçoit une \"Commission de Contribution aux Ventes (CCV) égale à un pourcentage du prix de vente du bien. Le montant de cette CCV peut être doublé si l'APL a été à l'origine d'un certain montant de chiffre d'affaires au cours de l'année précédente.",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/apl',
            'language' => 'fr',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'id' => 33,
            'title' => "Message d'information",
            'content' => "Les Agences Partenaires Locales (APL) sont des agences immobilières et d'affaires opérant dans des pays et territoires francophones qui souhaitent participer au courant d'investissement que développe le projet \"Investir en Australie\" (IEA). Dans ce cadre, l'APL est chargée d'une Mission d'Information, d'Orientation et de Promotion (MIOP) en direction des Membres du site IEA. Les Membres qui souhaitent une assistance locale pour leur démarche d'investissement en Australie souscrivent une relation exclusive de 180 jours avec une APL près de chez eux. En cas d'achat par le Membre inscrit auprès d'une APL, celle-ci perçoit une \"Commission de Contribution aux Ventes (CCV) égale à un pourcentage du prix de vente du bien. Le montant de cette CCV peut être doublé si l'APL a été à l'origine d'un certain montant de chiffre d'affaires au cours de l'année précédente.",
            'page_order' => '0',
            'parent_id' => '0',
            'path' => '/register/apl',
            'language' => 'en',
            'author_id' => '1',
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        
    }
}
