<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Florist;
use Illuminate\Http\Request;

class FloristController extends Controller
{
    public function index()
    {
        $florists = Florist::orderBy('rating', 'desc')->get();

        return view('user.florists_all', compact('florists'));
    }

    public function show($slug)
    {
        $florist = Florist::where('slug', $slug)->firstOrFail();

        if ($florist->is_always_closed) {
            return view('user.florists.closed', compact('florist'));
        }

        return view('user.florists.detail', compact('florist'));
    }

}
