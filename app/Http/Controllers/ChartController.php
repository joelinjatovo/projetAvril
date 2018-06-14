<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Localisation;
use App\Models\User;
use App\Models\State;
use DB;

class ChartController extends Controller
{
    public function categories(Request $request)
    {
        $items = Category::has('products')
            ->withCount('products')
            ->get();
        $data = array();
        foreach($items as $item){
            $data[] = [
                "type"=>$item->title,
                "number"=>$item->products_count,
                "color"=>"#B0DE09",
            ];
        }
        return response()->json([
            'state' => '1',
            'data' => $data,
        ]);
    }
    
    public function locations(Request $request, $type='product')
    {
        switch($type){
            case 'product':
                $items = State::join('products', 'products.state_id', '=', 'states.id')
                    ->select(DB::raw('count(*) as number, states.content as location'))
                    ->groupBy('location')
                    ->get();
            break;
            case 'afa':
                $items = State::join('users', 'users.state_id', '=', 'states.id')
                    ->select(DB::raw('count(*) as number, states.content as location'))
                    ->groupBy('location')
                    ->get();
                break;
            case 'user':
                $items = Localisation::join('users', 'users.location_id', '=', 'localizations.id')
                    ->select(DB::raw('count(*) as number, country as location'))
                    ->groupBy('location')
                    ->get();
            break;
            case 'member':
            case 'apl':
            case 'seller':
                $items = Localisation::join('users', 'users.location_id', '=', 'localizations.id')
                    ->where('users.role', $type)
                    ->select(DB::raw('count(*) as number, country as location'))
                    ->groupBy('location')
                    ->get();
            break;
                
        }

        return response()->json([
            'state' => '1',
            'data' => $items,
        ]);
    }
    
    public function dates(Request $request, $role = null)
    {    
        switch($role){
            case 'afa':
            case 'member':
            case 'apl':
            case 'seller':
                $items = DB::table('users')
                  ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as number'))
                  ->where('role', $role)
                  ->groupBy('date')
                  ->get();
                break;
            default:
                $items = DB::table('users')
                  ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as number'))
                  ->groupBy('date')
                  ->get();
                break;
        }
        
        return response()->json([
            'state' => '1',
            'data' => $items,
        ]);
    }
    
    public function carts(Request $request)
    {    
        $items = DB::table('carts')
                  ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as number'))
                  ->groupBy('date')
                  ->get();
        return response()->json([
            'state' => '1',
            'data' => $items,
        ]);
    }
    
    public function prices(Request $request)
    {
        $min = 0;
        $list = [300000,500000, 750000, 1000000];
        $data = [];
        foreach($list as $max){
            $item = Product::select(DB::raw('count(*) as number'))
                ->whereBetween('price', [$min, $max])
                ->first();
            if($item){
                $data[]=[
                    "label"=>'['.$min.' - '.$max.']',
                    "number"=>$item->number
                ];
            }
            $min = $max;
        }
        
        $item = Product::select(DB::raw('count(*) as number'))
            ->where('price', '>', $max)
            ->first();
        
        if($item){
            $data[]=[
                "label"=>' > '.$max,
                "number"=>$item->number
            ];
        }

        return response()->json([
            'state' => '1',
            'data' => $data,
        ]);
    }
    
    public function sellers(Request $request)
    {
        
        $items = User::where('role', 'seller')
            ->join('products', 'products.seller_id', '=', 'users.id')
            ->select(DB::raw('count(*) as number, type'))
            ->groupBy('type')
            ->get();
        for($i=0; $i<count($items); $i++){
            $item = $items[$i];
            if($item->type == 'organization'){
                $item->color="#FF9E01";
            }else if($item->type == 'person'){
                $item->color="#04D215";
            }
        }

        return response()->json([
            'state' => '1',
            'data' => $items,
        ]);
    }
}
