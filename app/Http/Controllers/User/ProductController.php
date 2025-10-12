<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Products::where('slug', $slug)->firstOrFail();
        $florist = $product->florist;

        return view('user.florists.detail_product', compact('product', 'florist'));
    }
}
