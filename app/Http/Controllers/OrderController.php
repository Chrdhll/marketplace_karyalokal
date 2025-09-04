<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik klien yang sedang login.
     */
    public function index()
    {
        $orders = Order::where('client_id', Auth::id())
                       ->latest()
                       ->paginate(10);
        
        // Nanti kita akan buat view untuk ini
        return view('orders.index', compact('orders')); 
    }

    /**
     * Menyimpan pesanan baru ke database.
     */
    public function store(Request $request, Gig $gig)
    {
        // 1. Keamanan: Pastikan yang memesan adalah 'client'
        if (Auth::user()->role !== 'client') {
            return back()->with('error', 'Hanya klien yang dapat membuat pesanan.');
        }

        // 2. Keamanan: Pastikan freelancer tidak memesan jasanya sendiri
        if ($gig->user_id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat memesan jasa Anda sendiri.');
        }

        // 3. Buat pesanan baru
        $order = Order::create([
            'gig_id' => $gig->id,
            'client_id' => Auth::id(),
            'freelancer_id' => $gig->user_id,
            'total_price' => $gig->price,
            'status' => 'pending', // Status awal saat pesanan dibuat
            // 'order_notes' => $request->input('notes'), // Opsional jika ada field catatan
        ]);

        // 4. Redirect ke halaman "Pesanan Saya" dengan pesan sukses
        return redirect()->route('order.index')->with('success', 'Pesanan Anda untuk jasa "'.$gig->title.'" telah berhasil dibuat!');
    }
}
