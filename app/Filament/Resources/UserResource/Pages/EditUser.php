<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

     protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ambil data user beserta relasinya
        $user = $this->getRecord();
        $user->load('freelancerProfile');

        // Gabungkan data user dan data profilnya ke dalam satu array
        // agar form bisa membacanya dengan notasi titik
        if ($user->freelancerProfile) {
            $data['freelancerProfile'] = $user->freelancerProfile->toArray();
        }

        return array_merge($data, $user->toArray());
    }

     protected function mutateFormDataBeforeSave(array $data): array
    {
        // 1. Ambil data yang spesifik untuk tabel freelancer_profiles
        $freelancerProfileData = $data['freelancerProfile'];
    
        // 2. Jika status diubah jadi 'approved', pastikan role di data utama juga 'freelancer'
        if ($freelancerProfileData['profile_status'] === 'approved') {
            $data['role'] = 'freelancer';
        }
    
        // 3. Simpan atau update data ke tabel freelancer_profiles secara manual
        $this->getRecord()->freelancerProfile()->updateOrCreate(
            ['user_id' => $this->getRecord()->id],
            $freelancerProfileData
        );
    
        // 4. Hapus data profil dari array utama agar tidak membingungkan proses simpan User
        unset($data['freelancerProfile']);
    
        // 5. Kembalikan data yang bersih (hanya berisi data untuk tabel users)
        return $data;
    }

     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
