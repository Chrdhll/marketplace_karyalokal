<?php

namespace App\Http\Controllers\Freelancer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data pesanan milik freelancer ini
        $orders = $user->ordersAsFreelancer();

        $completedOrders = $user->ordersAsFreelancer()->where('status', 'completed');

        // Hitung statistik
        $stats = [
        'pesanan_aktif' => $user->ordersAsFreelancer()->whereIn('status', ['paid', 'in_progress'])->count(),
        'pendapatan_bulan_ini' => (clone $completedOrders)->whereMonth('created_at', now()->month)->sum('freelancer_earning'),
        'rating' => number_format($user->freelancerProfile?->rating_average ?? 0, 1),
        'total_gigs' => $user->gigs()->count(),
        'total_pendapatan' => $orders->where('status', 'completed')->sum('total_price'),
    ];

        // Ambil 5 pesanan terbaru untuk ditampilkan di daftar
        $recentOrders = $user->ordersAsFreelancer()->with('client', 'gig')->latest()->take(5)->get();

         $chartDataRaw = $user->ordersAsFreelancer()
            ->where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_price) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('total', 'date');

             $chartData = [
            'labels' => $chartDataRaw->keys()->map(fn($date) => Carbon::parse($date)->format('d M')),
            'data'   => $chartDataRaw->values(),
        ];

        return view('freelancer.dashboard.index', compact('stats', 'recentOrders','chartData'));
    }
}