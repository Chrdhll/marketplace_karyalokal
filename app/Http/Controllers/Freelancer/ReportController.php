<?php
namespace App\Http\Controllers\Freelancer;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF
use App\Exports\OrdersExport;   // Export class baru yang akan kita buat
use Maatwebsite\Excel\Facades\Excel; // Import Excel

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter', 'all'); // Defaultnya tampilkan semua

        // Query dasar
        $ordersQuery = $user->ordersAsFreelancer()->where('status', 'completed');

        // Terapkan filter berdasarkan periode
        switch ($filter) {
            case 'week':
                $ordersQuery->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $ordersQuery->whereMonth('updated_at', now()->month);
                break;
            case 'year':
                $ordersQuery->whereYear('updated_at', now()->year);
                break;
        }

        // Hitung ringkasan statistik dari query yang sudah difilter
        $summary = [
            'total_revenue' => $ordersQuery->sum('freelancer_earning'),
            'total_orders' => $ordersQuery->count(),
        ];

        // Ambil data detail dengan paginasi
        $completedOrders = $ordersQuery->with('client', 'gig')->latest()->paginate(20);

        return view('freelancer.reports.index', compact('completedOrders', 'summary', 'filter'));
    }

     public function exportPdf(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter', 'all'); // Defaultnya tampilkan semua
        // Jalankan query yang sama persis seperti di index() untuk mendapatkan data yang difilter
        // ... (copy-paste logika query dari index())
        $ordersQuery = $user->ordersAsFreelancer()->where('status', 'completed');
        switch ($filter) {
            case 'week':
                $ordersQuery->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $ordersQuery->whereMonth('updated_at', now()->month);
                break;
            case 'year':
                $ordersQuery->whereYear('updated_at', now()->year);
                break;
        }

        $summary = [
        'total_revenue' => $ordersQuery->sum('freelancer_earning'),
        'total_orders' => $ordersQuery->count(),
     ];

        $orders = $ordersQuery->with('client', 'gig')->latest()->get();
        
       $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('freelancer.reports.pdf', compact('orders', 'summary', 'filter'));
       return $pdf->stream('laporan-pendapatan-'.$filter.'.pdf');
    }

    public function exportExcel(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter', 'all'); 
        $ordersQuery = $user->ordersAsFreelancer()->where('status', 'completed');
         switch ($filter) {
            case 'week':
                $ordersQuery->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $ordersQuery->whereMonth('updated_at', now()->month);
                break;
            case 'year':
                $ordersQuery->whereYear('updated_at', now()->year);
                break;
        }


        $orders = $ordersQuery->get();

        return Excel::download(new OrdersExport($orders), 'laporan-pendapatan.xlsx');
    }

    // app/Http/Controllers/Freelancer/ReportController.php

    public function print(Request $request)
    {
        $user = Auth::user();
        $filter = $request->get('filter', 'all'); // Defaultnya tampilkan semua

        // Query dasar
        $ordersQuery = $user->ordersAsFreelancer()->where('status', 'completed');

        // Terapkan filter berdasarkan periode
        switch ($filter) {
            case 'week':
                $ordersQuery->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $ordersQuery->whereMonth('updated_at', now()->month);
                break;
            case 'year':
                $ordersQuery->whereYear('updated_at', now()->year);
                break;
        }

        // Hitung ringkasan statistik dari query yang sudah difilter
        $summary = [
            'total_revenue' => $ordersQuery->sum('freelancer_earning'),
            'total_orders' => $ordersQuery->count(),
        ];

        // Ambil data detail dengan paginasi
        $completedOrders = $ordersQuery->with('client', 'gig')->latest()->paginate(20);
        
        // Tapi, kirim ke view yang berbeda
        return view('freelancer.reports.print', compact('completedOrders', 'summary', 'filter'));
    }
}