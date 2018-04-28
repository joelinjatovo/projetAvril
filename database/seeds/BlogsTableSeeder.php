<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->insert([
            'id' => "1",
            'slug' => "construire-pour-revendre-ce-quil-faut-savoir",
            'title' => "Construire Pour Revendre : Ce Qu’il Faut Savoir",
            'content' => "L’immobilier est et sera toujours une valeur sûre. Surtout que depuis peu, les crédits immobiliers sont plus accessibles pour tous les ménages. Mais pour rentabiliser au maximum son placement, il reste encore à bien choisir ses investissements. Entre les SCPI, les achats clés en main et l’alternative de faire construire son bien : on n’a aujourd’hui que l’embarras du choix. Et il semble que la dernière option soit plus avantageuse que les autres. En outre, les possibilités de rentabilisations sont encore plus nombreuses. Les propriétaires peuvent faire une location, proposer des baux commerciaux, ou simplement revendre leur bien. Depuis quelques années, le dispositif fiscal en matière d’investissement immobilier ne cesse d’augmenter. On peut voir que trouver un logement décent sans payer le prix fort est assez difficile. De plus en plus de ménages optent désormais pour la construction dans le but d’une revente, pour le bonheur des entrepreneurs. Le point. Les frais de construction d’une maison reviennent moins chers que d’acheter une maison clé en main. Certes, acquérir une maison peut être plus rapide, mais la première option revêt des avantages plus intéressants. Le prix moyen pour un terrain constructible est de 140€ le m2, alors que le prix moyen pour une maison est de 1 850€ le m2 et 3 300€ pour un appartement. Tout dépend des régions dans lesquels vous investissez. Dans les villes comme Paris, Nantes, Bordeaux, Lyon et toute la côte méditerranéenne entre Monaco et Montpellier le prix moyen est de 3 700€ le m2 pour une maison alors que pour le reste de la France, il sera de 1 800€ le m2. Tout dépend des régions dans lesquels vous investissez. Dans les villes comme Paris, Nantes, Bordeaux, Lyon et toute la côte méditerranéenne entre Monaco et Montpellier le prix moyen est de 3 700€ le m2 pour une maison alors que pour le reste de la France, il sera de 1 800€ le m2.",
            'created_at' => date("Y-m-d H:i:s"),
            'view_count' => 150,
            'author_id' => 1,
        ]);
        DB::table('blogs')->insert([
            'id' => "2",
            'slug' => "zoom-sur-le-metier-de-promoteur-immobilier",
            'title' => "Zoom Sur Le Métier De Promoteur Immobilier",
            'content' => "L’immobilier est un secteur très vaste et pris en charge par de nombreuses personnes qui présentent des fonctions différentes à des responsabilités toutes aussi différentes. Avec une influence grandissante sur l’économie à l’échelle mondiale, l’immobilier est un des grands piliers de la mise en marche d’une économie très importante. Bien que de nombreuses personnes travaillent dans l’immobilier, et cela aussi bien en tant que professionnel que particulier, il est nécessaire d’avoir des compétences bien définies. Un des métiers les plus courants dans le domaine est le métier de « promoteur immobilier ». Mais que peut bien faire un promoteur immobilier ? Un promoteur immobilier est celui qui vend des espaces construits ou à construire. Auparavant, on le connaissait comme étant un monteur d’affaire immobilière. En effet des dizaines d’années plus tôt, avec une intense construction de logements, les spéculations immobilières forgèrent petit à petit le personnage du promoteur immobilier jusqu’à lui attribué une fonction officielle. Et dans son acception, le promoteur immobilier est celui qui est à la charge du processus de l’offre sur le marché. C’est-à-dire qu’il prend en compte les demandes, les aspects réglementaires, le foncier et les moyens de financement dans un projet immobilier tout en prenant compte les risques.",
            'created_at' => date("Y-m-d H:i:s"),
            'view_count' => 120,
            'author_id' => 1,
        ]);
        DB::table('blogs')->insert([
            'id' => "3",
            'slug' => "tout-savoir-sur-lassurance-pour-un-pret-immobilier",
            'title' => "Tout Savoir Sur L’assurance Pour Un Prêt Immobilier",
            'content' => "Lorsque vous prenez un crédit immobilier, votre banquier vous parlera surement de l’assurance prêt immobilier. Votre banquier peut vous le réclamer pour un prêt à taux zéro, pour un prêt relais ou pour tout autre type de prêt immobilier. Vous pouvez entendre et lire que cette assurance est obligatoire, ce qui n’est pas le cas. Nous allons vous apporter dans ce dossier plusieurs informations par rapport à ce sujet et vous présenter si elle est vraiment indispensable pour votre prêt. Lorsqu’on contracte un crédit immobilier et qu’on évoque l’assurance prêt immobilier ou l’assurance emprunteur correspondante, on se demande si elle est obligatoire. Nous tenons à souligner que contrairement à l’assurance auto ou l’assurance habitation, elle n’est pas légalement obligatoire, mais certains établissements bancaires et établissements financiers peuvent vous l’exiger. Depuis 2010 avec l’entrée en vigueur de la loi Lagarde, vous n’êtes pas obligé de prendre l’offre d’assurance proposée par votre prêteur, ce qui vous offre un libre choix de l’assurance-crédit qui vous convient, et ce, auprès d’un autre établissement. Dans certains cas, notamment ceux qui ont un patrimoine important, il est possible de contourner cette obligation de l’assurance prêt immobilier en mettant en garantie vos biens A quoi sert-elle ? Si certains établissements bancaires ou institutions financières exigent l’assurance crédit immobilier, c’est pour se protéger de toute défaillance de remboursement de son client. Il faut noter que cette assurance ne protège pas que l’organisme prêteur, car il couvre également le souscripteur de crédit.",
            'created_at' => date("Y-m-d H:i:s"),
            'view_count' => 10,
            'author_id' => 1,
        ]);
        DB::table('blogs')->insert([
            'id' => "4",
            'slug' => "nos-conseils-pour-mettre-en-valeur-sa-maison-pour-mieux-la-vendre",
            'title' => "Nos Conseils Pour Mettre En Valeur Sa Maison Pour Mieux La Vendre",
            'content' => "Vendre une maison n’est pas une mince à faire, surtout si vous ne souhaitez pas avoir recours aux services d’une agence immobilière. Il faut assurer le respect de certaines normes de construction. Les inspecteurs sont particulièrement exigeants quant à la performance des immeubles de nos jours. Néanmoins, pour les particuliers en quête d’un nouvel investissement, l’aménagement est le meilleur moyen de les convaincre. Les visites sont une partie importante de la transaction. Pour vous, qui pour une raison ou une autre, doit trouver un acheteur rapidement pour votre résidence, voici quelques conseils pour mettre en valeur la maison afin de mieux la vendre : rapidement et à bon prix. Une maison, par définition, doit être confort et pratique. On dit souvent que votre décoration doit être à l’image de votre personnalité. D’ailleurs, sur internet, vous avez plusieurs astuces pour ce faire. Différents styles sont disponibles, allant du vintage au plus moderne. Néanmoins, pour une vente, opter pour un aménagement neutre est de mise.",
            'created_at' => date("Y-m-d H:i:s"),
            'view_count' => 1000000,
            'author_id' => 1,
        ]);
        DB::table('blogs')->insert([
            'id' => "5",
            'slug' => "quel-est-le-premier-investissement-immobilier-ideal-pour-un-jeune-couple",
            'title' => "Quel Est Le Premier Investissement Immobilier Idéal Pour Un Jeune Couple ?",
            'content' => "Que ce soit pour y vivre, ou pour en faire un complément de revenu, investir dans l’immobilier reste une valeur sûre. Pour un jeune couple, le premier investissement immobilier idéal est, incontestablement, l’achat de la résidence principale. L’acquisition de la première résidence apportera au couple un sentiment de sécurité et leur est bénéfique sur le plan financier. En effet, la différence de prix entre la location et l’achat immobilier est minime, surtout avec les taux de crédit favorisant les primo-accédants. De plus, opter pour un investissement immobilier c’est aussi se construire un patrimoine pour la génération future. Néanmoins, cet investissement est loin d’être sans risques. Sans préparation, l’achat de votre premier appartement peut vite tourner au cauchemar et même gâcher vos projets d’avenir. Pour vous aider, voici quelques astuces pour effectuer votre premier investissement. Premier investissement immobilier : être primo-accédant Le terme « primo-accédant » est un terme utilisé dans le domaine de l’immobilier pour désigner un particulier se lançant dans son premier achat immobilier. En général, un primo-accédant n’est pas encore propriétaire d’un bien immobilier. Ce sont, en général, des jeunes couples dont la plupart sont dans une classe d’âge de 25 à 34 ans. Plus de 80% des primo-accédants sont des couples à la recherche de leur premier foyer dont les 58% ont au moins un enfant. Les plus prisés par ces jeunes parents sont les maisons de ville ou les pavillons. Plus précisément, le terme « primo-accédant » ne s’applique pas forcement à une personne encore nouvelle dans le monde de l’investissement immobilier. En effet, celui-ci peut être un ancien propriétaire mais pour une raison ou une autre ne l’est plus depuis plus de deux ans avant son prochain achat. Enfin, une personne possédant plusieurs biens immobiliers peut très bien être juridiquement un primo-accédant si elle n’est pas propriétaire de sa résidence principale.",
            'created_at' => date("Y-m-d H:i:s"),
            'view_count' => 50,
            'author_id' => 1,
        ]);
    }
}
