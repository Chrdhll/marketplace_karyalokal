<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfilFreelanceController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); // Langsung ambil data user yang login
        return view('freelancer.profil.edit', compact('user'));
    }

    // app/Http/Controllers/Freelancer/ProfilFreelanceController.php

    public function update(Request $request)
    {
        // Validasi sudah benar, kita hanya perlu menambahkan 'keahlian'
        $validated = $request->validate([
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'portfolio' => 'nullable|file|mimes:pdf|max:5120',
            'cv_file_path' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $user = Auth::user();

        // 1. LENGKAPI SEMUA DATA TEKS DARI VALIDASI
        $dataToUpdate = [
            'headline' =>$request->input('headline'),
            'bio' => $request->input('bio'),
            'company_name' => $request->input('company_name'),
            'location' => $request->input('location'),
        ];

        // 2. LOGIKA UNTUK RESUBMIT SETELAH DITOLAK
        // Jika profil sebelumnya ditolak, ubah statusnya jadi pending lagi untuk direview ulang
        if ($user->profile_status == 'rejected') {
            $dataToUpdate['profile_status'] = 'pending';
        }

        // 3. TAMBAHKAN HANDLER UNTUK SEMUA FILE

        // Handle upload Foto Profil
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture_path) {
                Storage::disk('public')->delete($user->profile_picture_path);
            }
            $dataToUpdate['profile_picture_path'] = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        // Handle upload Portofolio
        if ($request->hasFile('portfolio')) {
            if ($user->portfolio) {
                Storage::disk('public')->delete($user->portfolio);
            }
            $dataToUpdate['portfolio'] = $request->file('portfolio')->store('portfolios', 'public');
        }

        // Handle upload CV
        if ($request->hasFile('cv_file_path')) {
            if ($user->cv_file_path) {
                Storage::disk('public')->delete($user->cv_file_path);
            }
            $dataToUpdate['cv_file_path'] = $request->file('cv_file_path')->store('cvs', 'public');
        }
        // Langsung update data user
        $user->update($dataToUpdate);

        return redirect()->route('freelancer.profil.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
