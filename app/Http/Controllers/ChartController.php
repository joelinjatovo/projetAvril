<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class ChartController extends Controller
{
    public function categories(Request $request)
    {
        
        $items = Category::all();
        $data = array();
        foreach($items as $item){
            $data[] = [
                "type"=>$item->title,
                "nombre"=>count($item->products),
                "color"=>"#B0DE09",
            ];
        }
        if ($request->isMethod('post')){    
            return response()->json(['response' => 'This is post method']); 
        }

        return response()->json([
            'state' => '1',
            'response' => 'This is get method',
            'data' => $data,
        ]);
    }
}
