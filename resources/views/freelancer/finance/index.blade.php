@extends('layouts.freelancer')
@section('title', 'Keuangan')

@section('content')
    <section class="section_gap mt-5">
        <div class="container my-5">
            <h1 class="mb-4">Keuangan & Penarikan Dana</h1>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }} <button type="button"
                        class="close" data-dismiss="alert"><span>&times;</span></button></div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul><button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-7">
                    {{-- KARTU SALDO & FORM PENARIKAN --}}
                    <div class="card shadow-sm mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Tarik Saldo</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle text-muted">Saldo Tersedia</h6>
                            <h2 class="card-title font-weight-bold text-success mb-4">Rp
                                {{ number_format($user->freelancerProfile->balance, 2, ',', '.') }}</h2>

                            <form action="{{ route('freelancer.withdrawals.request') }}" method="POST"
                                onsubmit="return confirm('Anda yakin ingin menarik dana sejumlah ini? Saldo akan langsung dipotong.');">
                                @csrf
                                <div class="form-group">
                                    <label for="amount">Jumlah Penarikan (min. Rp 50.000)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                        <input type="number" name="amount" id="amount" class="form-control"
                                            placeholder="0" min="50000" max="{{ $user->freelancerProfile->balance }}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dana akan ditransfer ke rekening bank utama Anda.</label>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                    {{ count($bankAccounts) > 0 ? '' : 'disabled' }}>
                                    Ajukan Penarikan
                                </button>
                                @if (count($bankAccounts) == 0)
                                    <small class="form-text text-danger">Anda harus menambahkan rekening bank terlebih
                                        dahulu.</small>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- KARTU RIWAYAT PENARIKAN --}}
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Riwayat Penarikan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($withdrawals as $withdrawal)
                                            <tr>
                                                <td>{{ $withdrawal->created_at->format('d M Y') }}</td>
                                                <td>Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</td>
                                                <td>
                                                    @if ($withdrawal->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($withdrawal->status == 'processed')
                                                        <span class="badge badge-success">Processed</span>
                                                    @else
                                                        <span class="badge badge-danger">Rejected</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Belum ada riwayat penarikan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if ($withdrawals->hasPages())
                                <div class="mt-3">{{ $withdrawals->links() }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Rekening Bank Anda</h5>
                        </div>
                        <div class="card-body">
                            {{-- Daftar Rekening Bank --}}
                            @forelse ($bankAccounts as $account)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <strong class="d-block">{{ $account->bank_name }}</strong>
                                        <span class="text-muted">{{ $account->account_number }} (a.n
                                            {{ $account->account_holder_name }})</span>
                                    </div>
                                    <form action="{{ route('freelancer.bank-accounts.destroy', $account->id) }}"
                                        method="POST" onsubmit="return confirm('Hapus rekening bank ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">&times;</button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-muted">Anda belum menambahkan rekening bank.</p>
                            @endforelse

                            <hr>
                            <h6 class="mb-3">Tambah Rekening Baru</h6>
                            <form action="{{ route('freelancer.bank-accounts.store') }}" method="POST">
                                @csrf
                                <div class="form-group"><input type="text" name="bank_name" class="form-control"
                                        placeholder="Nama Bank (e.g. BCA, BNI)" required></div>
                                <div class="form-group"><input type="text" name="account_holder_name"
                                        class="form-control" placeholder="Nama Pemilik Rekening" required></div>
                                <div class="form-group"><input type="number" name="account_number" class="form-control"
                                        placeholder="Nomor Rekening" required></div>
                                <button type="submit" class="btn btn-primary btn-block">Tambah Rekening</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
