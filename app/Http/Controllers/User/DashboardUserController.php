<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Florist;
use App\Models\Products;

class DashboardUserController extends Controller
{
    public function index()
    {
        $florists = Florist::inRandomOrder()->take(6)->get();

        $topProducts = Products::select('products.*')
            ->join(DB::raw('(SELECT florists_id, MAX(price) as max_price FROM products GROUP BY florists_id) as t'),
                   function($join) {
                       $join->on('products.florists_id', '=', 't.florists_id')
                            ->on('products.price', '=', 't.max_price');
                   })
            ->with('florist')
            ->take(6)
            ->get();

        return view('user.dashboard_user', compact('florists', 'topProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([
                'florists' => [],
                'products' => []
            ]);
        }

        $florists = Florist::where('name', 'like', "%{$query}%")
            ->select('id', 'name', 'slug', 'rating', 'image')
            ->limit(5)
            ->get();

        $products = Products::with('florist:id,name,slug')
            ->whereHas('florist')
            ->where('name', 'like', "%{$query}%")
            ->select('id', 'name', 'price', 'slug', 'image', 'florists_id as florist_id')
            ->limit(5)
            ->get();

        return response()->json([
            'florists' => $florists,
            'products' => $products,
        ]);
    }

    public function getNearbyFlorists(Request $request)
    {
        $lat = $request->query('lat');
        $lon = $request->query('lon');

        if (!$lat || !$lon) {
            return response()->json(['error' => 'Lokasi tidak valid.'], 400);
        }

        $florists = Florist::select('*', DB::raw("
            (6371 * acos(cos(radians($lat)) * cos(radians(latitude)) *
            cos(radians(longitude) - radians($lon)) +
            sin(radians($lat)) * sin(radians(latitude)))) AS distance
        "))
        ->orderBy('distance', 'asc')
        ->take(6)
        ->get();

        return response()->json($florists);
    }

}
