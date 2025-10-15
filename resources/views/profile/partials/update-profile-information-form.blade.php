<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Informasi Profil
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Perbarui informasi profil akun dan alamat email Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- TAMBAHKAN enctype UNTUK UPLOAD FILE --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- FOTO PROFIL (BARU) --}}
        <div>
            <x-input-label for="profile_picture" value="Foto Profil" />
            <div class="mt-2 flex items-center gap-x-3">
                <img class="h-20 w-20 rounded-full object-cover" 
                     src="{{ auth()->user()->profile_picture_path ? Storage::url(auth()->user()->profile_picture_path) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name) }}" 
                     alt="Foto Profil">
                <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        {{-- NAMA --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- USERNAME (BARU) --}}
        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        {{-- EMAIL --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                {{-- ... (logika verifikasi email tidak berubah) ... --}}
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p ...>{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>