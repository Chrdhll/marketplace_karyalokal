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

        // 1. Validasi semua data yang berhubungan dengan PROFIL FREELANCER
        $validatedData = $request->validate([
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'keahlian' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'cv_file_path' => [ 
                Rule::requiredIf(!$user->freelancerProfile?->cv_file_path),
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120'
            ],
            'portfolio' => [
                Rule::requiredIf(!$user->freelancerProfile?->portfolio),
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120'
            ],
        ]);

        // 2. Siapkan data TEKS dari hasil validasi untuk disimpan/diupdate
        $profileData = [
            'headline' => $validatedData['headline'],
            'bio' => $validatedData['bio'],
            'keahlian' => $validatedData['keahlian'] ?? null,
            'location' => $validatedData['location'],
        ];

        // 3. Cek apakah ini submission pertama kali, jika ya, set status 'pending'
        if (!$user->freelancerProfile) {
            $profileData['profile_status'] = 'pending';
        }

        // 4. Handle file uploads dan tambahkan path-nya ke data yang akan disimpan
        if ($request->hasFile('cv_file_path')) {
            if ($user->freelancerProfile?->cv_file_path) {
                Storage::disk('public')->delete($user->freelancerProfile->cv_file_path);
            }
            $profileData['cv_file_path'] = $request->file('cv_file_path')->store('cvs', 'public');
        }
        if ($request->hasFile('portfolio')) {
            if ($user->freelancerProfile?->portfolio) {
                Storage::disk('public')->delete($user->freelancerProfile->portfolio);
            }
            $profileData['portfolio'] = $request->file('portfolio')->store('portfolios', 'public');
        }

        // 5. Simpan ke tabel freelancer_profiles menggunakan relasi updateOrCreate
        $user->freelancerProfile()->updateOrCreate(
            ['user_id' => $user->id], // Kunci untuk mencari/membuat
            $profileData  // Data untuk diisi
        );

        // 6. Redirect ke halaman "Lihat Profil"
        return redirect()->route('freelancer.profil.show')->with('success', 'Profil profesional berhasil diperbarui!');
    }
}
