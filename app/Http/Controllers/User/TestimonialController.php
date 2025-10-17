<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Florist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function create($florist_id)
    {
        $florist = Florist::findOrFail($florist_id);
        return view('user.testimonials.create', compact('florist'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'florist_id' => 'required|exists:florists,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        Testimonial::create([
            'florist_id' => $request->florist_id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('order.history')
                        ->with('success', 'Terima kasih! Testimoni kamu berhasil dikirim 🌸');
    }


    public function showFloristTestimonials($florist_id)
    {
        $florist = Florist::findOrFail($florist_id);
        $testimonials = $florist->testimonials()->with('user')->latest()->paginate(6);

        return view('user.florists.testimonials', compact('florist', 'testimonials'));
    }
}
