<?php

namespace App\Http\Controllers\Florist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductFloristController extends Controller
{
    public function index()
    {
        $florist = Auth::user()->florist;
        $products = Products::where('florists_id', $florist->id)->latest()->get();

        return view('florist.products.index', compact('products'));
    }

    public function create()
    {
        return view('florist.products.create');
    }

    public function store(Request $request)
    {
        $florist = Auth::user()->florist;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1000',
            'flowers' => 'nullable|array',
            'flowers.*' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            $imagePath = $request->hasFile('image')
                ? $request->file('image')->store('products', 'public')
                : null;

            Products::create([
                'florists_id' => $florist->id,
                'name' => $validated['name'],
                'description' => $validated['description'] ?? '',
                'price' => $validated['price'],
                'flowers' => array_values(array_filter($validated['flowers'] ?? [])),
                'image' => $imagePath,
            ]);

            return redirect()
                ->route('florist.products.index')
                ->with('success', '✅ Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    public function edit(Products $product)
    {
        return view('florist.products.update', compact('product'));
    }

    public function update(Request $request, Products $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:1000',
            'flowers' => 'nullable|array',
            'flowers.*' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $product->image = $request->file('image')->store('products', 'public');
            }

            $product->update([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? '',
                'price' => $validated['price'],
                'flowers' => array_values(array_filter($validated['flowers'] ?? [])),
            ]);

            return redirect()
                ->route('florist.products.index')
                ->with('success', ' Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Gagal memperbarui produk: ' . $e->getMessage());
        }
    }

    public function destroy(Products $product)
    {
        try {
            $product->delete();
            return redirect()
                ->route('florist.products.index')
                ->with('success', '🗑️ Produk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('florist.products.index')
                ->with('error', '❌ Gagal menghapus produk: ' . $e->getMessage());
        }
    }

    public function show(Products $product)
    {
        return view('florist.products.show', compact('product'));
    }

}
