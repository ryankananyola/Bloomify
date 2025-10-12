<section id="orderFormSection" 
    class="order-form-section py-5" 
    style="display:none; width:100vw; background-color:#fff7fa; border-top:3px solid #e64b7d; margin-left:calc(-50vw + 50%);">

    <div class="container-fluid px-0">
        <div class="text-center mb-5">
            <h3 class="fw-bold" style="color:#e64b7d;">Hi, Dear!</h3>
            <p class="text-muted">Untuk melakukan pemesanan, kamu dapat mengisi formulir di bawah ini. 
                <br>Kami akan segera menghubungi kamu untuk memastikan setiap detail pesanan terasa sempurna !💐</p>
        </div>

        <div class="d-flex justify-content-center">
            <div class="form-box p-4 rounded-4 shadow-sm" style="background-color:#fff; max-width:800px; width:90%;">
                <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="me-3 rounded-3" 
                        style="width:100px; height:100px; object-fit:cover;">
                    <div>
                        <h5 class="mb-1 fw-semibold" style="color:#e64b7d;">{{ $product->name }}</h5>
                        <small class="text-muted">Rp{{ number_format($product->price, 0, ',', '.') }}</small>
                    </div>
                </div>

                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="customer_name" class="form-control border-pink rounded-3" placeholder="Nama kamu" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="customer_phone" class="form-control border-pink rounded-3" placeholder="08xxxxxxx" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Quantity</label>
                            <input type="number" name="quantity" class="form-control border-pink rounded-3" placeholder="1" min="1" value="1">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pick Up</label>
                            <select name="pickup_method" class="form-select border-pink rounded-3" required>
                                <option selected disabled>Choice</option>
                                <option value="Pick Up">Pick Up</option>
                                <option value="Delivery Go-Send">Delivery Go-Send</option>
                                <option value="Delivery Florist">Delivery Florist</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Pick Up Date</label>
                            <input type="date" name="pickup_date" class="form-control border-pink rounded-3" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Time</label>
                            <input type="time" name="pickup_time" class="form-control border-pink rounded-3" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Paper Bag</label>
                            <select name="paper_bag" class="form-select border-pink rounded-3">
                                <option selected disabled>Choice</option>
                                <option value="Plastic">Plastic (Rp. 0)</option>
                                <option value="Paper Bag">Paper Bag (Rp. 10.000)</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Greeting Card</label>
                            <select id="greeting_card" name="greeting_card" class="form-select border-pink rounded-3">
                                <option selected disabled>Choice</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" class="form-control border-pink rounded-3" rows="3" placeholder="Masukkan alamat kamu"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Greeting Message</label>
                            <textarea id="greeting_message" name="greeting_message" class="form-control border-pink rounded-3" rows="3" placeholder="Tulis ucapan (opsional)"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Additional Request</label>
                            <textarea name="additional_request" class="form-control border-pink rounded-3" rows="3" placeholder="Contoh: bunga mawar merah diganti putih ya kak!"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select border-pink rounded-3" required>
                                <option selected disabled>Pilih metode</option>
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>

                        <div class="col-12 text-end mt-4">
                            <button type="button" 
                                    class="btn btn-light border rounded-pill px-4 me-2" 
                                    onclick="toggleOrderForm(event)">Cancel</button>
                            <button type="submit" 
                                    class="btn text-white fw-semibold rounded-pill px-5" 
                                    style="background-color:#e64b7d;">Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const greetingCardSelect = document.getElementById('greeting_card');
    const greetingMessageField = document.getElementById('greeting_message');

    greetingCardSelect.addEventListener('change', function() {
        if (this.value === '1') { 
            greetingMessageField.disabled = false;
            greetingMessageField.placeholder = "Tulis ucapan di sini...";
            greetingMessageField.focus();
        } else if (this.value === '0') { 
            greetingMessageField.disabled = true;
            greetingMessageField.value = "";
            greetingMessageField.placeholder = "Tidak menggunakan kartu ucapan";
        }
    });
});
</script>

<style>
    .border-pink {
        border: 1.5px solid #e64b7d;
    }
    .border-pink:focus {
        border-color: #e64b7d;
        box-shadow: 0 0 0 0.2rem rgba(230,75,125,0.15);
    }

    .order-form-section.show {
        display: block !important;
        animation: fadeSlideIn 0.6s ease;
    }

    @keyframes fadeSlideIn {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .form-box {
        margin: 0 auto; 
    }
</style>
