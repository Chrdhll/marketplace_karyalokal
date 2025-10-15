<div class="p-4">
    <h3 class="text-lg font-bold mb-2">Detail Rekening Bank</h3>
    @forelse ($bankAccounts as $account)
        <div class="mb-3 p-3 rounded-lg bg-gray-100">
            <p class="mb-0"><strong>Nama Bank:</strong> {{ $account->bank_name }}</p>
            <p class="mb-0"><strong>No. Rekening:</strong> {{ $account->account_number }}</p>
            <p class="mb-0"><strong>Atas Nama:</strong> {{ $account->account_holder_name }}</p>
        </div>
    @empty
        <p class="text-red-500">Freelancer ini belum menambahkan rekening bank.</p>
    @endforelse
</div>