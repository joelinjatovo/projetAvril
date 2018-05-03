<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Search;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Perform global search.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'etats' => 'nullable|max:255',
            'villes' => 'nullable|max:255',
            'suburbs' => 'nullable|max:255'
        ]);

        $recherche = new Search();
        $produit = new Produit();
        $result = $produit->queryprincipal();

        if( !empty($request->post('etats') || !empty($request->post('villes'))))
        {
            $result = "";
            $result = $recherche->searchLocalisation($request->post('etats'),$request->post('villes'));
        }

        if(!empty($result) && !empty($request->post('prix')) || !empty($request->post('superficie')) )
        {
            if(!is_null($request->post('prix')))
            {
                $array_prix = preg_split("/,/", $request->post('prix'));
                $prix['min'] = $array_prix[0];
                $prix['max'] = $array_prix[1];
            }
            if(!is_null($request->post('superficie')))
            {
                $array_surface = preg_split("/,/", $request->post('superficie'));
                $surface['min'] =  $array_surface[0];
                $surface['max'] = $array_surface[1];
            }

            if( !empty($prix) && !empty($surface) )
            $result = $result->whereBetween('produits.prix', [ $prix['min'], $prix['max'] ])->whereBetween('produits.surface', [ $surface['min'], $surface['max'] ]);
            if(!empty($prix))
               $result = $result->whereBetween('produits.prix', [ $prix['min'], $prix['max'] ]);
            elseif(!empty($surface))
               $result = $result->whereBetween('produits.surface', [ $surface['min'], $surface['max'] ]);
        }

        if(!empty($request->post('sdb')) || !empty($request->post('ch')))
        {
            $sdb = preg_split("/,/", $request->post('sdb'));
            $ch = preg_split("/,/", $request->post('ch'));
            if(!empty($request->post('sdb')) && !empty($request->post('ch')))
            {
                $result = $result->whereBetween('optionproduits.sdb',[$sdb[0],$sdb[1]])->whereBetween('optionproduits.ch',[$ch[0],$ch[1]]);   
            }
            if( !empty($request->post('sdb')) || empty($request->post('ch')) )
            {
                $result = $result->whereBetween('optionproduits.sdb',[$sdb[0],$sdb[1]]);
            }
            elseif( empty($request->post('sdb')) || !empty($request->post('ch')) )
            {
                $result = $result->whereBetween('optionproduits.ch',[$ch[0],$ch[1]]); 
            }
        }

        if(!empty($request->post('typelogement')))
        {
            $result = $result->where('optionproduits.typepropriete',$request->post('typelogement'));
        }
        $resultat = $result->paginate(20);
        $resultat = Produit::createSlug($resultat);
    	return view('search.index')
            ->with('items', $resultat);
    }

}
