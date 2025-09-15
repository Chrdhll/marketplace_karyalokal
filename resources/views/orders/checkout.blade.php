@extends('layouts.template')
@section('title', 'Konfirmasi Pesanan')
@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <h1>Konfirmasi Pesanan</h1>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Anda akan memesan:</h5>
                    <p><strong>Jasa:</strong> {{ $gig->title }}</p>
                    <p><strong>Freelancer:</strong> {{ $gig->user->name }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($gig->price, 0, ',', '.') }}</p>
                    <form action="{{ route('checkout.process', $gig->id) }}" method="POST" id="checkout-form">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg">Lanjutkan ke Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts-footer')
        <script>
            document.getElementById('checkout-form').addEventListener('submit', function(e) {
                const button = e.target.querySelector('button[type="submit"]');
                button.disabled = true;
                button.textContent = 'Memproses...';
            });
        </script>
    @endpush
@endsection
