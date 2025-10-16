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
            <p>Pesanan {{ $order->order_number }} telah dibuat. Silakan lanjutkan pembayaran.</p>
            <button id="pay-button" class="btn btn-success btn-lg">Bayar Sekarang</button>
            <form action="{{ route('order.cancel', $order->uuid) }}" method="POST" class="mt-3"
                onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link text-danger">Batalkan Pesanan</button>
            </form>
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
                    // KODE BARU
                    window.location.replace("{{ route('order.index') }}?payment=success");
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

{{-- @push('scripts-footer')
<script type="text/javascript">
  // Script untuk memicu Midtrans Snap
  document.getElementById('pay-button').addEventListener('click', function () {
    window.snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){
        // Gunakan replace agar tidak bisa di-"back"
        window.location.replace("{{ route('order.index') }}?payment=success");
      },
      // ...
    });
  });

  window.history.replaceState(null, null, "{{ route('index') }}"); 
</script>
@endpush --}}
