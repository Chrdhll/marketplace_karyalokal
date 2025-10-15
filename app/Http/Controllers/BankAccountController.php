<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankAccountController extends Controller
{
        public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_holder_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
        ]);

        Auth::user()->bankAccounts()->create($validated);

        return back()->with('success', 'Rekening bank berhasil ditambahkan.');
    }

    // Menghapus rekening bank
    public function destroy(BankAccount $bankAccount)
    {
        // Keamanan: pastikan user hanya bisa menghapus rekeningnya sendiri
        if ($bankAccount->user_id !== Auth::id()) {
            abort(403);
        }
        $bankAccount->delete();
        return back()->with('success', 'Rekening bank berhasil dihapus.');
    }
}
