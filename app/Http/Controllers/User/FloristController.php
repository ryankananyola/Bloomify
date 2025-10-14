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

        $currentTime = \Carbon\Carbon::now('Asia/Jakarta');

        $open = \Carbon\Carbon::createFromFormat('H:i:s', $florist->open_time, 'Asia/Jakarta');
        $close = \Carbon\Carbon::createFromFormat('H:i:s', $florist->close_time, 'Asia/Jakarta');

        $isClosed = ($florist->is_always_closed == true)
            || $currentTime->lt($open)
            || $currentTime->gt($close);

        if ($isClosed) {
            return view('user.florists.closed', compact('florist'));
        }

        return view('user.florists.detail', compact('florist'));
    }

    public function search(Request $request, $slug)
    {
        $florist = \App\Models\Florist::where('slug', $slug)->firstOrFail();

        $query = $request->get('q');

        $products = $florist->products()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%");
            })
            ->get();

        return response()->json($products);
    }

}
