<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ProfilFreelanceController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('freelancer.profil.show', compact('user'));
    }
    public function edit()
    {
        $user = Auth::user(); // Langsung ambil data user yang login
        return view('freelancer.profil.edit', compact('user'));
    }

    // app/Http/Controllers/Freelancer/ProfilFreelanceController.php

   public function update(Request $request)
{
    $user = Auth::user();

    // Cek apakah ini submission pertama kali (sebelumnya belum ada bio)
    $isFirstSubmission = !$user->bio; 
    
    // VALIDASI YANG DISEMPURNAKAN
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'username' => [
            'required',
            'string',
            'max:50',
            'alpha_dash', // Hanya boleh huruf, angka, strip (-), dan underscore (_)
            Rule::unique('users')->ignore($user->id), // Unik, kecuali untuk user ini sendiri
        ],
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id), // Email juga harus unik
        ],
        'headline' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:1000',
        'location' => 'nullable|string|max:255',
        'company_name' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'cv_file_path' => [ 
            Rule::requiredIf(!$user->cv_file_path),
            'nullable', 'file', 'mimes:pdf', 'max:5120'
        ],
        'portfolio' => [
            Rule::requiredIf(!$user->portfolio),
            'nullable', 'file', 'mimes:pdf', 'max:5120'
        ],
    ]);

    // Mengambil semua data input teks
    $dataToUpdate = $request->only([
        'name', 'username', 'email', 'headline', 'bio', 'keahlian', 'location', 'company_name'
    ]);

    // LOGIKA STATUS BARU
    if ($isFirstSubmission) {
        $dataToUpdate['profile_status'] = 'pending';
    }

    // HANDLE FILE UPLOAD
    if ($request->hasFile('profile_picture')) {
        if ($user->profile_picture_path) Storage::disk('public')->delete($user->profile_picture_path);
        $dataToUpdate['profile_picture_path'] = $request->file('profile_picture')->store('profile-pictures', 'public');
    }
    if ($request->hasFile('cv_file_path')) { 
        if ($user->cv_file_path) Storage::disk('public')->delete($user->cv_file_path);
        $dataToUpdate['cv_file_path'] = $request->file('cv_file_path')->store('cvs', 'public');
    }
    if ($request->hasFile('portfolio')) {
        if ($user->portfolio) Storage::disk('public')->delete($user->portfolio);
        $dataToUpdate['portfolio'] = $request->file('portfolio')->store('portfolios', 'public');
    }

    $user->update($dataToUpdate);
    
    return redirect()->route('freelancer.profil.show')->with('success', 'Profil berhasil diperbarui!');
}
}
