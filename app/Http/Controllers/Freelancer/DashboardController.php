<?php

namespace App\Http\Controllers\Freelancer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data pesanan milik freelancer ini
        $orders = $user->ordersAsFreelancer();

        // Hitung statistik
        $stats = [
            'pesanan_baru' => $orders->where('status', 'paid')->count(),
            'pesanan_dikerjakan' => $orders->where('status', 'in_progress')->count(),
            'pesanan_selesai' => $orders->where('status', 'completed')->count(),
            'total_pendapatan' => $orders->where('status', 'completed')->sum('total_price'),
        ];

        // Ambil 5 pesanan terbaru untuk ditampilkan di daftar
        $recentOrders = $user->ordersAsFreelancer()->with('client', 'gig')->latest()->take(5)->get();

        return view('freelancer.dashboard.index', compact('stats', 'recentOrders'));
    }
}