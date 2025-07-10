<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReportController extends Controller
{
    public function index()
    {
        // Ambil semua order yang sudah sel
        $orders = Order::with('items.product')
            ->where('status', 'done')
            ->latest()
            ->get();

        // Hitung total pendapatan
        $totalRevenue = $orders->sum('total_price');

        return view('admin.reports.index', compact('orders', 'totalRevenue'));
    }
}
