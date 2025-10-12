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
}
