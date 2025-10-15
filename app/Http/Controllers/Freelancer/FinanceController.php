<?php

namespace App\Http\Controllers\Freelancer;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BankAccount; // <-- Import

class FinanceController extends Controller
{
    // Menampilkan halaman utama finansial
    public function index()
    {
        $user = Auth::user();
        $bankAccounts = $user->bankAccounts()->get();
        $withdrawals = $user->withdrawals()->latest()->paginate(10);

        return view('freelancer.finance.index', compact('user', 'bankAccounts', 'withdrawals'));
    }

    // Memproses permintaan penarikan dana
    public function requestWithdrawal(Request $request)
    {
        $user = Auth::user();
        $balance = $user->freelancerProfile->balance;

        $validated = $request->validate([
            'amount' => 'required|numeric|min:50000|max:' . $balance,
        ]);

        // 1. Kurangi saldo freelancer
        $user->freelancerProfile->decrement('balance', $validated['amount']);

        // 2. Catat permintaan penarikan
        $user->withdrawals()->create([
            'amount' => $validated['amount'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan penarikan dana sebesar Rp ' . number_format($validated['amount']) . ' telah diajukan.');
    }
}
