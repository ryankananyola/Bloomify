<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Florist;

class ProductController extends Controller
{
    public function show($florist_slug, $product_slug)
    {
        $florist = Florist::where('slug', $florist_slug)->firstOrFail();

        $product = Products::where('slug', $product_slug)
                           ->where('florists_id', $florist->id)
                           ->firstOrFail();

        return view('user.florists.detail_product', compact('product', 'florist'));
    }
}
