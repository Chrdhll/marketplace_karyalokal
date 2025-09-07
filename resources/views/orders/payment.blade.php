@extends('layouts.template')
@section('title', 'Pembayaran')
{{-- Tambahkan script Midtrans Snap di head --}}
@push('scripts')
    <script type="text/javascript"
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5 text-center">
            <h1>Selesaikan Pembayaran Anda</h1>
            <p>Pesanan #{{ $order->id }} telah dibuat. Silakan lanjutkan pembayaran.</p>
            <button id="pay-button" class="btn btn-success btn-lg">Bayar Sekarang</button>
        </div>
    </section>
@endsection

@push('scripts-footer')
    <script type="text/javascript">
        // Cari tombol bayar
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Panggil Snap.pay dengan Snap Token yang kita dapat dari controller
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* Kamu bisa tambahkan aksi di sini, misalnya redirect */
                    alert("payment success!");
                    window.location.href = "{{ route('order.index') }}";
                },
                onPending: function(result) {
                    /* Aksi jika pembayaran pending */
                    alert("wating your payment!");
                    window.location.href = "{{ route('order.index') }}";
                },
                onError: function(result) {
                    /* Aksi jika pembayaran error */
                    alert("payment failed!");
                    window.location.href = "{{ route('order.index') }}";
                },
                onClose: function() {
                    /* Aksi jika pop-up ditutup sebelum pembayaran selesai */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });
    </script>
@endpush
