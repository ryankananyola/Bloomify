<?php

namespace App\Http\Controllers\Florist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductFloristController extends Controller
{
    public function index()
    {
        $floristId = Auth::user()->florist->id;
        $products = Products::where('florists_id', $floristId)->paginate(10);
        return view('florist.products.index', compact('products'));
    }

    public function create()
    {
        return view('florist.products.create');
    }

    public function store(Request $request)
    {
        $floristId = Auth::user()->florist->id;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:4096',
        ]);

        $path = $request->file('image')?->store('products', 'public');

        Products::create([
            'florists_id' => $floristId,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'image' => $path,
            'slug' => Str::slug($validated['name'].'-'.Str::random(5)),
        ]);

        return redirect()->route('florist.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Products $product)
    {
        if ($product->florists_id !== Auth::user()->florist->id) {
            abort(403);
        }
        return view('florist.products.edit', compact('product'));
    }

    public function update(Request $request, Products $product)
    {
        if ($product->florists_id !== Auth::user()->florist->id) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('florist.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Products $product)
    {
        if ($product->florists_id !== Auth::user()->florist->id) {
            abort(403);
        }

        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
