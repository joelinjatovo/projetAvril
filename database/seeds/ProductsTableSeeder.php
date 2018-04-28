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
            'reference' => "ref-p000001",
            'slug' => "surfers-paradise-appartement",
            'title' => "Surfers Paradise Appartement",
            'content' => "Surfers Paradise - Appartement & loft à vendre Australie> Queensland> Surfers Paradise 1 500 000 EUR Appartement & Loft (Vente) 3 ch 2 sdb 265 m² Cet appartement de 3 chambres de taille généreuse bénéficie d'une impression de sol de 265m2. Une suite parentale de taille presque égale à celle du salon et couplée à une robe de chambre connectée à la salle de bain garantit à ceux qui le désirent un bon goût de vie en appartement. Pour le plat principal, le côté nord de la Gold Coast vous permettra de profiter d'une vue alléchante sur la magnifique Broadwater, de superbes toits de la ville animés par la vie et de vues sereines ininterrompues sur l'océan depuis le salon! Entièrement équipée avec cuisinière à gaz et table de pique-nique, la vue sur l'océan encapsulant de la cuisine fait pour une expérience culinaire merveilleuse pour les amis, la famille ou les invités! Plus de fonctionnalités comprennent une salle d'eau, une buanderie séparée, une climatisation entièrement canalisée, une salle multimédia et 2 parkings. Un investissement incroyable ou incroyable en live! Caractéristiques et installations du bâtiment Q1: Concierge / Tour Booking Desk. Club des résidents, salles de réception et installations de conférence. Cinéma / cinéma interne. Deux piscines extérieures / lagunes. Une piscine intérieure chauffée. Spa intérieur. Salles de vapeur intérieures et saunas. Gymnase entièrement équipé. Salle de jeux. Célèbre Longboards Café et Pool Bar. Gestion sur site. Sécurité totale. Animaux acceptés. Zone de vente au détail avec dépanneur. Minutes à pied de la plage de baignade. Minutes à pied de Surfers Paradise avec des boutiques, des restaurants et plus",
            'quantity' => "1",
            'price' => "4859000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 1,
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "2",
            'reference' => "ref-p000002",
            'slug' => "melbourne-appartement",
            'title' => "Melbourne Appartement",
            'content' => "C'est un superbe appartement de 2 chambres situé à Melbourne en Australie. L'appartement pourrait être utilisé comme une maison de vacances ou comme une résidence permanente. Il y a une salle de réception incluse avec la propriété. En outre, la propriété est également entièrement meublée. Avec la propriété il y a une piscine communale incluse. Avec la piscine communale il y a aussi un jardin privé. La taille de la parcelle est mesurée à 75 mètres carrés. avec la surface couverte étant 75m2. Parking disponible inclus avec la propriété serait hors stationnement dans la rue.",
            'quantity' => "1",
            'price' => "7800000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 1,
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "3",
            'reference' => "ref-p000003",
            'slug' => "newport-bureau",
            'title' => "Newport Bureau",
            'content' => "C'est une opportunité à ne pas manquer. Travaillez au bord de la mer ... Cette suite bureau au bord de l'eau donnant sur les magnifiques voies navigables de Pittwater est située dans la banlieue très prisée de Newport. Situé dans un lotissement résidentiel sécurisé, la suite bénéficie d'une excellente lumière naturelle tout au long de la journée depuis les grandes baies vitrées qui donnent sur une vue dont vous ne serez jamais fatigué! Caractéristiques de la propriété: - Bureau de 41m² + Cour extérieure exclusive de 21m² - Bureau au bord de l'eau - Suite magnifiquement présentable donnant sur Pittwater - Planchers de bois à l'entrée - Système de climatisation indépendant - Développement sécurisé avec accès par ascenseur - Système d'intercom et câblé - Parking unique sécurisé - & kitchen En plus, il y a une opportunité d'acquérir 9 Moorings pour une entreprise marine si nécessaire - 7 x situé à Winji Jimmi Bay, 1 x situé à Northern End of Scotland Island, 1 x situé à America's Bay",
            'quantity' => "1",
            'price' => "3600000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 2,
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "4",
            'reference' => "ref-p000004",
            'slug' => "bangholme-bureau",
            'title' => "Bangholme Bureau",
            'content' => "Une chance rare de posséder cette usine / entrepôt, il conviendra à une variété d'occupants / affaires. Situation centrale accès facile à toutes les principales artères et autoroutes, un grand parking à l'arrière et large route excellente pour l'accès des gros camions. Caractéristiques du bâtiment comprennent: -3 bureaux-cuisine / salle à manger, toilettes -Hauteur volet roulant -Grande puissance -Parking à l'arrière -Area de 484m2 env.",
            'quantity' => "1",
            'price' => "9500000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 2,
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "5",
            'reference' => "ref-p000005",
            'slug' => "bridgewater-terrain",
            'title' => "Bridgewater Terrain",
            'content' => "Ce bloc de construction serait l'un des meilleurs blocs à gauche dans la région. Prendre des vues sensationnelles du pont Bridgewater et au-delà dans une direction et des vues du mont Wellington et au-delà dans l'autre sens. Avec une superficie approximative de 762 m2, ce terrain est assez grand pour construire la maison de vos rêves ou construire plusieurs unités (STCA). Il y a une réserve du Conseil à la droite de la propriété et elle aura des vues qui ne seront jamais perdues. Les bus ne sont qu'à quelques pas. Il y a des écoles et de nombreux magasins, y compris les grands supermarchés à seulement quelques minutes. Si vous cherchez un bloc avec des vues incroyables, alors c'est ici",
            'quantity' => "1",
            'price' => "1000000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 3,
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "6",
            'reference' => "ref-p000006",
            'slug' => "tugun-terrain",
            'title' => "Tugun Terrain",
            'content' => "Offert à la vente, un terrain de 20 acres situé à proximité de tout le Tweed a à offrir. Pittoresque avec la façade de l'eau à Piggabeen Creek, la propriété a un potentiel incroyable pour le développement futur. * 20 acres * Emplacement idéal et endroit où vivre * Derrière / Ouest de l'aéroport de Coolangatta (pas sous aucune trajectoire de vol) * 10-15 minutes de l'aéroport de Coolangatta et des plages. * 400 mètres de front de mer de marée 'Piggabeen Creek' Utilisation du terrain: * Tourisme écologique, cheval, terrain de golf, etc .. * Développement futur 'Potentiel incroyable'",
            'quantity' => "1",
            'price' => "500000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 3,
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "7",
            'reference' => "ref-p000007",
            'slug' => "mount-barker-terrain",
            'title' => "Mount Barker Terrain",
            'content' => "C'est une offre unique de terrains vacants. Idéalement situé dans une magnifique rue bordée d'arbres, ce lotissement de près de 350 m² est situé à quelques pas des magasins, cabinets médicaux, banques, écoles et transports. Actuellement zoné «Résidentiel». Le conseil envisagera une utilisation à la maison ou au bureau. Il est presque impossible d'obtenir une allocation centrale comme celle-ci au Mont Barker aujourd'hui, alors ne tardez pas!",
            'quantity' => "1",
            'price' => "10000000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 4,
            'author_id' => 1,
        ]);
        DB::table('products')->insert([
            'id' => "8",
            'reference' => "ref-p000006",
            'slug' => "redland-bay-terrain",
            'title' => "Redland Bay Terrain",
            'content' => "Ce bloc résidentiel de 658 m2 est merveilleusement positionné, pratique pour le club de golf, les boutiques locales et la jetée de Macleay Island et le centre d'affaires principal. Le bloc est complètement dégagé, pentes doucement de la route pavée, n'a pas de problèmes de drainage, est clôturé sur 2 côtés et a actuellement des vues sur le terrain de golf à l'arrière. Macleay Island offre un style de vie unique, avec une atmosphère de village convivial, un environnement de parc marin pittoresque et avec les magasins, clubs et services essentiels ici sur l'île prêt pour que vous appréciiez",
            'quantity' => "1",
            'price' => "2590000.00",
            'currency' => "eur",
            'tma' => "0.20",
            'created_at' => date("Y-m-d H:i:s"),
            'category_id' => 4,
            'author_id' => 1,
        ]);
    }
}
