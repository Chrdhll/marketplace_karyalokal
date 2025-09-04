<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan yang masuk untuk freelancer yang sedang login.
     */
    public function index()
    {
        // Ambil data pesanan di mana user ini adalah freelancer-nya
        $orders = Auth::user()->ordersAsFreelancer()
            ->with('client', 'gig') // <-- Tips Performa: Eager Loading
            ->latest()
            ->paginate(10);

        return view('freelancer.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // 1. Keamanan: Pastikan user yang login adalah freelancer dari pesanan ini
        if ($order->freelancer_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // 2. Validasi: Pastikan status yang dikirim adalah nilai yang diizinkan
        $validated = $request->validate([
            'status' => ['required', Rule::in(['in_progress', 'completed', 'cancelled'])]
        ]);

        // 3. Update status pesanan
        $order->update([
            'status' => $validated['status']
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
    }
}

