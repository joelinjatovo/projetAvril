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
        $i = 1;
        $pages = [
            [
                'title'     => 'Accueil',
                'content'   => '',
                'title_en'  => 'Home',
                'content_en'=> '',
                'path'      => '/',
                'childs'    => [
                    [
                        'title'     => 'Communauté Francophone',
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet.',
                       
                        'title_en'  => 'Franco Communauty',
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet.',
                        
                        'path'      => '/',
                    ],
                    [
                        'title'     => 'Comment fonctionne le site investire en australie?',
                        'content'   => '<iframe src="https://www.youtube.com/embed/dzHw2RRyk68" allowfullscreen=""></iframe>',
                        
                        'title_en'  => 'How does work IEA Web Site?',
                        'content_en'=> '<iframe src="https://www.youtube.com/embed/dzHw2RRyk68" allowfullscreen=""></iframe>',
                        
                        'path'      => '/',
                    ],
                    [
                        'title'     => 'Notre mission / Notre vision',
                        'content'   => '<div class="row">
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
                        
                        'title_en'  => 'Our mission / Our vision',
                        'content_en'=> '<div class="row">
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
                        
                        'path'      => '/',
                    ],
                ],
            ],
            
            //Termes et Conditions
            [
                'title'     => 'Termes et Conditions',
                'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                
                'title_en'  => 'Terms And Conditions',
                'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                
                'path'      => '/terms',
                'childs'    => [],
            ],
            
            // Guide de l'investisseur
            [
                'title'     => "Guide de l'investisseur",
                'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                
                'title_en'  => 'Investissor Guid',
                'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                
                'path'      => '/help',
                'childs'    => [],
            ],
            
            // Confidentialites
            [
                'title'     => 'Confidentialités',
                'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                
                'title_en'  => 'Confidentialities',
                'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                
                'path'      => '/confidentialities',
                'childs'    => [],
            ],
            
            // NOs services
            [
                'title'     => 'Nos services',
                'content'   => '',
                
                'title_en'  => 'Our services',
                'content_en'=> '',
                
                'path'      => '/services',
                'childs'    => [
                    [
                        'title'     => 'Conseil Juridique',
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'title_en'  => 'Conseil Juridique (fr)',
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'path'      => '/services',
                    ],
                    [
                        'title'     => 'Immigrations',
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'title_en'  => 'Immigrations (fr)',
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'path'      => '/services',
                    ],
                    [
                        'title'     => 'Conseils finaniers et bancaires',
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'title_en'  => 'Conseils finaniers et bancaires (fr)',
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'path'      => '/services',
                    ],
                    [
                        'title'     => 'Conseil Comptable et Fiscale',
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'title_en'  => 'Conseil Comptable et Fiscale (fr)',
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'path'      => '/services',
                    ],
                    [
                        'title'     => 'Agence de traduction',
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'title_en'  => 'Traduction agency',
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'path'      => '/services',
                    ],
                    [
                        'title'     => 'Agence Partenaire Locale',
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'title_en'  => 'Local Partenary Agency',
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'path'      => '/services',
                    ],
                    [
                        'title'     => "Conseil en évaluation d'affaires financiaires et commerciales",
                        'content'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'title_en'  => "Conseil en évaluation d'affaires financiaires et commerciales (fr)",
                        'content_en'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliquan ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi sollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. Pellentesque fermentum nisl purus, et iaculis lectus pharetra sit amet. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pulvinar faucibus neque, nec rhoncus nunc ultrices sit amet. Curabitur ac sagittis neque, vel egestas est. Aenean elementum, erat at aliquet hendrerit, elit nisl posuere tortor, id suscipit diam dui sed nisi. Morbi s ollicitudin massa vel tortor consequat, eget semper nisl fringilla. Maecenas at hendrerit odio. Sed in mi eu quam suscipit bibendum quis at orci. P ellentesque',
                        
                        'path'      => '/services',
                    ],
                ],
            ],
            
            [
                'title'     => 'Publicités',
                'content'   => '',
                
                'title_en'  => 'Publicities',
                'content_en'=> '',
                
                'path'      => 'pubs',
                'childs'    => [],
            ],
            
            [
                'title'     => "Message d'information",
                'content'   => "Merci de votre intention de vous inscrire en qualité de Membre sur le site \"Investir en Australie\". En plus de pouvoir, comme tout Visiteur, voir dans le détail les produits et opérer des sélections multicritères, votre inscription vous permettra d'enregistrer vos recherches multicritères, d'enregistrer les produits qui vous intéressent dans vos \"favoris\", de partager des produits avec vos amis par emails et sur les réseaux sociaux, d'échanger avec une Agence Francophone Australienne située à proximité du bien qui vous intéresse. Lorsque vous aurez pris la décision d'acheter vous pourrez lancer la procédure d'acquisition en ligne. Au cours de cette procédure il vous sera proposé les services de certains de nos partenaires australiens francophones auxquels vous pourriez faire appel si vous en aviez besoin.",
                
                'title_en'  => 'Explanation Message',
                'content_en'=> "Merci de votre intention de vous inscrire en qualité de Membre sur le site \"Investir en Australie\". En plus de pouvoir, comme tout Visiteur, voir dans le détail les produits et opérer des sélections multicritères, votre inscription vous permettra d'enregistrer vos recherches multicritères, d'enregistrer les produits qui vous intéressent dans vos \"favoris\", de partager des produits avec vos amis par emails et sur les réseaux sociaux, d'échanger avec une Agence Francophone Australienne située à proximité du bien qui vous intéresse. Lorsque vous aurez pris la décision d'acheter vous pourrez lancer la procédure d'acquisition en ligne. Au cours de cette procédure il vous sera proposé les services de certains de nos partenaires australiens francophones auxquels vous pourriez faire appel si vous en aviez besoin.",
                
                'path'      => '/register/member',
                'childs'    => [],
            ],
            
            [
                'title'     => "Message d'information",
                'content'   => "The Seller must accept The Terms and Conditions of Use of \"Investir en Australie\" website and make the commitment to display only products that can be sold to non-resident foreigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).",
                
                'title_en'  => 'Explanation Message',
                'content_en'=> "The Seller must accept The Terms and Conditions of Use of \"Investir en Australie\" website and make the commitment to display only products that can be sold to non-resident foreigners in accordance with Australian law and the rules applicable by the Foreign Investment Review Board (FIRB).",
                
                'path'      => '/register/seller',
                'childs'    => [],
            ],
            
            [
                'title'     => "Message d'information",
                'content'   => "The Australian Francophone Agents are Australian agents who are partners with \"Investir en Australie\" website. They are the essential link in the material realization of the sale of the products posted on the site, but they can also sell their own products.The Australian Francophone Agent must make the commitment to provide prospective or actual purchasers with a service in French during preliminary sales and during sales transactions. They must also accept that a clientele introductory fee (\"Commission de Présentation de Clientèle\" - CPC) will be due to the company managing IEA website in case of actual sale of products, accept and respect the Terms and Conditions of Use of the site, and make the commitment to verify and guarantee that the products for the sale of which they are the operating agent are effectively residential, land, industrial or commercial properties which may be sold to non-resident foreigners in accordance with the Australian law and the rules applicable to foreign investment by the Foreign Investment Review Board (FIRB).",
                
                'title_en'  => 'Explanation Message',
                'content_en'=> "The Australian Francophone Agents are Australian agents who are partners with \"Investir en Australie\" website. They are the essential link in the material realization of the sale of the products posted on the site, but they can also sell their own products.The Australian Francophone Agent must make the commitment to provide prospective or actual purchasers with a service in French during preliminary sales and during sales transactions. They must also accept that a clientele introductory fee (\"Commission de Présentation de Clientèle\" - CPC) will be due to the company managing IEA website in case of actual sale of products, accept and respect the Terms and Conditions of Use of the site, and make the commitment to verify and guarantee that the products for the sale of which they are the operating agent are effectively residential, land, industrial or commercial properties which may be sold to non-resident foreigners in accordance with the Australian law and the rules applicable to foreign investment by the Foreign Investment Review Board (FIRB).",
                
                'path'      => '/register/afa',
                'childs'    => [],
            ],
            
            [
                'title'     => "Message d'information",
                'content'   => "Les Agences Partenaires Locales (APL) sont des agences immobilières et d'affaires opérant dans des pays et territoires francophones qui souhaitent participer au courant d'investissement que développe le projet \"Investir en Australie\" (IEA). Dans ce cadre, l'APL est chargée d'une Mission d'Information, d'Orientation et de Promotion (MIOP) en direction des Membres du site IEA. Les Membres qui souhaitent une assistance locale pour leur démarche d'investissement en Australie souscrivent une relation exclusive de 180 jours avec une APL près de chez eux. En cas d'achat par le Membre inscrit auprès d'une APL, celle-ci perçoit une \"Commission de Contribution aux Ventes (CCV) égale à un pourcentage du prix de vente du bien. Le montant de cette CCV peut être doublé si l'APL a été à l'origine d'un certain montant de chiffre d'affaires au cours de l'année précédente.",
                
                'title_en'  => 'Explanation Message',
                'content_en'=> "Les Agences Partenaires Locales (APL) sont des agences immobilières et d'affaires opérant dans des pays et territoires francophones qui souhaitent participer au courant d'investissement que développe le projet \"Investir en Australie\" (IEA). Dans ce cadre, l'APL est chargée d'une Mission d'Information, d'Orientation et de Promotion (MIOP) en direction des Membres du site IEA. Les Membres qui souhaitent une assistance locale pour leur démarche d'investissement en Australie souscrivent une relation exclusive de 180 jours avec une APL près de chez eux. En cas d'achat par le Membre inscrit auprès d'une APL, celle-ci perçoit une \"Commission de Contribution aux Ventes (CCV) égale à un pourcentage du prix de vente du bien. Le montant de cette CCV peut être doublé si l'APL a été à l'origine d'un certain montant de chiffre d'affaires au cours de l'année précédente.",
                
                'path'      => '/register/apl',
                'childs'    => [],
            ],
        ];
        
        $id = 1;
        foreach($pages as $page){
            DB::table('pages')->insert([
                'id'         => $id,
                'title'      => $page['title'],
                'content'    => $page['content'],
                'title_en'   => $page['title_en'],
                'content_en' => $page['content_en'],
                'path'       => $page['path'],
                'author_id'  => 1,
                'created_at' => date("Y-m-d H:i:s"),
            ]);
            $parentId = $id++;
            foreach($page['childs'] as $key => $child){
                DB::table('pages')->insert([
                    'id'         => $id++,
                    'title'      => $child['title'],
                    'content'    => $child['content'],
                    'title_en'   => $child['title_en'],
                    'content_en' => $child['content_en'],
                    'path'       => $child['path'],
                    'parent_id'  => $parentId,
                    'page_order' => $key,
                    'author_id'  => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                ]);
            }
        }
    }
}
