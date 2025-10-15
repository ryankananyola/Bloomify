@extends('layouts.florist')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-pink-600">✏️ Edit Produk</h2>
        <a href="{{ route('florist.products.index') }}" class="btn btn-outline-pink rounded-pill shadow-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-lg rounded-4 p-4">
        <form action="{{ route('florist.products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="animate__animated animate__fadeInUp">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" rows="4" class="form-control rounded-3">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Daftar Bunga</label>
                <div id="flowers-list">
                    @foreach($product->flowers ?? [] as $flower)
                        <div class="input-group mb-2">
                            <input type="text" name="flowers[]" class="form-control rounded-start-3" value="{{ $flower }}">
                            <button type="button" class="btn btn-outline-pink remove-flower">🗑</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-flower" class="btn btn-sm btn-outline-pink rounded-pill">
                    <i class="bi bi-plus"></i> Tambah Bunga
                </button>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Produk</label>
                <input type="file" name="image" class="form-control rounded-3" accept="image/*">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="mt-3 rounded-4 shadow-sm" width="200" alt="Current Image">
                @endif
            </div>

            <button type="submit" class="btn btn-pink px-5 py-2 rounded-pill shadow-sm mt-3">
                <i class="bi bi-save me-1"></i> Perbarui Produk
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const list = document.getElementById("flowers-list");
        const addBtn = document.getElementById("add-flower");

        addBtn.addEventListener("click", () => {
            const div = document.createElement("div");
            div.classList.add("input-group", "mb-2");
            div.innerHTML = `
                <input type="text" name="flowers[]" class="form-control rounded-start-3" placeholder="Nama bunga..." />
                <button type="button" class="btn btn-outline-pink remove-flower">🗑</button>
            `;
            list.appendChild(div);
        });

        list.addEventListener("click", (e) => {
            if (e.target.classList.contains("remove-flower")) {
                e.target.closest(".input-group").remove();
            }
        });
    });
</script>

<style>
    .text-pink-600 { color: #e64b7d !important; }
    .btn-pink { background-color: #e64b7d; color: white; transition: all 0.3s ease; }
    .btn-pink:hover { background-color: #d83b6e; transform: translateY(-2px); box-shadow: 0 6px 12px rgba(230,75,125,0.3); }
    .btn-outline-pink { color: #e64b7d; border-color: #e64b7d; transition: all 0.3s ease; }
    .btn-outline-pink:hover { background-color: #e64b7d; color: white; }
    .form-control { border-radius: 12px; border: 1.5px solid #f1c3d2; transition: all 0.2s ease; }
    .form-control:focus { border-color: #e64b7d; box-shadow: 0 0 0 0.2rem rgba(230,75,125,0.15); }
</style>
@endsection
