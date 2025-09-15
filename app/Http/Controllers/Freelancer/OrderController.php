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

    public function deliverWork(Request $request, Order $order)
    {
        // Keamanan
        if ($order->freelancer_id !== Auth::id() || $order->status !== 'in_progress') {
            abort(403);
        }

        $validated = $request->validate([
            'delivered_file' => 'required|file|max:20480', // Max 20MB
            'delivery_notes' => 'nullable|string',
        ]);

        // Simpan file di storage 'local' (bukan public) agar aman
        $filePath = $request->file('delivered_file')->store('deliveries');

        $order->update([
            'status' => 'completed',
            'delivered_file_path' => $filePath,
            'delivery_notes' => $validated['delivery_notes'],
        ]);

        return back()->with('success', 'Hasil pekerjaan berhasil dikirim!');
    }


    public function updateStatus(Request $request, Order $order)
    {
        // 1. Keamanan: Pastikan user yang login adalah freelancer dari pesanan ini
        if ($order->freelancer_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        // 2. Keamanan tambahan: Jangan biarkan status diubah jika sudah selesai atau batal
        if (in_array($order->status, ['completed', 'cancelled', 'dispute'])) {
            return back()->with('error', 'Status pesanan ini tidak dapat diubah lagi.');
        }

        // 3. Validasi: Pastikan status yang dikirim adalah nilai yang diizinkan
        $validated = $request->validate([
            'status' => ['required', Rule::in(['in_progress', 'completed', 'cancelled'])]
        ]);

        // 4. Update status pesanan
        $order->update([
            'status' => $validated['status']
        ]);

        // 5. Redirect kembali dengan pesan sukses
        return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
    }
}
