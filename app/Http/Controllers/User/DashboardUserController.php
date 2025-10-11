<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Florist;

class DashboardUserController extends Controller
{
    public function index()
    {
        $florists = Florist::inRandomOrder()->take(6)->get();

        return view('user.dashboard_user', compact('florists'));
    }
}
