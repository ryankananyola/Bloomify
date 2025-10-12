<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Florist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'florist_id' => 'required|exists:florists,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        Testimonial::create([
            'florist_id' => $request->florist_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas testimoni kamu!');
    }

    public function showFloristTestimonials($florist_id)
    {
        $florist = Florist::findOrFail($florist_id);
        $testimonials = $florist->testimonials()->with('user')->latest()->paginate(6);

        return view('user.florists.testimonials', compact('florist', 'testimonials'));
    }
}
