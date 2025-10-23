<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Florist;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing'); 
    }

    public function nearbyFlorists(Request $request)
    {
        $lat = $request->lat;
        $lon = $request->lon;

        if (!$lat || !$lon) {
            return response()->json(['error' => 'Coordinates not provided'], 400);
        }

        $florists = Florist::selectRaw("
            florists.*, 
            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
            * cos(radians(longitude) - radians(?)) 
            + sin(radians(?)) * sin(radians(latitude)))) AS distance
        ", [$lat, $lon, $lat])
        ->orderBy('distance', 'asc')
        ->take(6)
        ->get();

        return response()->json($florists);
    }
}
