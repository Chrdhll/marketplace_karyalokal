<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage; // <-- Import Storage
use Illuminate\Validation\Rule; //

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Ambil data yang sudah divalidasi dari ProfileUpdateRequest
        $validatedData = $request->validated();

        // Validasi tambahan untuk username & profile_picture di sini
        $request->validate([
            'username' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Isi data user dengan data yang sudah divalidasi
        $user->fill($validatedData);
        $user->username = $request->input('username'); // Isi username

        // Jika user ganti email, reset verifikasinya
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle upload foto profil
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture_path) {
                Storage::disk('public')->delete($user->profile_picture_path);
            }
            // Simpan foto baru
            $user->profile_picture_path = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
