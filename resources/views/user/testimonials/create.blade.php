@extends('layouts.layout_user')

@section('title', 'Kirim Testimoni - Bloomify')

@section('content')
<div class="container py-5" style="max-width: 700px; margin-top: 90px;">
    <h4 class="fw-bold mb-4 text-center" style="color:#e64b7d;">
        Kirim Testimoni untuk {{ $florist->name }}
    </h4>

    <form action="{{ route('testimonial.store') }}" method="POST">
        @csrf
        <input type="hidden" name="florist_id" value="{{ $florist->id }}">

        <div class="mb-3">
            <label class="form-label fw-semibold">Rating</label>
            <select name="rating" class="form-select rounded-pill" required>
                <option value="">Pilih Rating</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Komentar</label>
            <textarea name="comment" class="form-control rounded-4" rows="4" maxlength="500" required></textarea>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn text-white rounded-pill px-4" style="background-color:#e64b7d;">
                <i class="bi bi-chat-heart"></i> Kirim Testimoni
            </button>
        </div>
    </form>
</div>
@endsection
