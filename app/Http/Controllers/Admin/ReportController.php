<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use App\Models\Item;

class ReportController extends Controller
{
    // Pending Orders
    public function pendingOrders()
    {
        $orders = SalesOrder::where('status', 'pending')->with('customer')->get();
        return view('admin.reports.pending_orders', compact('orders'));
    }

    // Confirmed Orders
    public function confirmedOrders()
    {
        $orders = SalesOrder::where('status', 'confirmed')->with('customer')->get();
        return view('admin.reports.confirmed', compact('orders'));
    }

    // Item Stock Balance
    public function itemStock()
    {
        $items = Item::with('company')->get();
        return view('admin.reports.itemstock', compact('items'));
    }
}
