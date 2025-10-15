{{-- KARTU UNTUK UPDATE PASSWORD --}}
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5 class="mb-0">{{ auth()->user()->password ? 'Ubah Password' : 'Buat Password' }}</h5>
    </div>
    <div class="card-body">
        {{-- Ini adalah form dari partial Breeze, disajikan ulang dengan style kita --}}
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            @if (auth()->user()->password)
                <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <div class="input-group" style="width: 36rem">
                        <input id="current_password" name="current_password" type="password" class="form-control"
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                data-target="current_password">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('current_password', 'updatePassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif

            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <label for="password">{{ auth()->user()->password ? 'Password Baru' : 'Password' }}</label>
                    <div class="input-group">
                        <input id="password" name="password" type="password" class="form-control"
                            autocomplete="new-password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                data-target="password">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password', 'updatePassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            class="form-control" autocomplete="new-password">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                data-target="password_confirmation">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    @error('password_confirmation', 'updatePassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-primary">Simpan Password</button>
                @if (session('status') === 'password-updated')
                    <p class="ml-3 text-success mb-0">Password berhasil di simpan.</p>
                @endif
            </div>

        </form>
    </div>
</div>
