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
}
