<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\Company;

class SalesController extends Controller
{
    // Sales Dashboard
    public function dashboard()
    {
        $myOrders = SalesOrder::with('items.item')
            ->where('sales_user_id', auth()->id())
            ->get();

        $pendingOrders = $myOrders->where('status','pending')->count();
        $confirmedOrders = $myOrders->where('status','confirmed')->count();

        return view('sales.dashboard', compact('myOrders','pendingOrders','confirmedOrders'));
    }

    // Customers
    public function customers()
    {
        $customers = Customer::all();
        return view('sales.customers.index', compact('customers'));
    }

    public function createCustomer()
    {
        $companies = Company::orderBy('name')->get(); 
        return view('sales.customers.create', compact('companies'));
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customers',
            'phone'=>'nullable',
        ]);

        Customer::create($request->all());

        return redirect()->route('sales.customers')->with('success','Customer created.');
    }

    // Sales Orders
    public function orders()
    {
        $orders = SalesOrder::with('customer','items.item')->get();
        return view('sales.orders.index', compact('orders'));
    }

    public function createOrder()
    {
        $customers = Customer::all();
        $items = Item::all();
        return view('sales.orders.create', compact('customers','items'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'customer_id'=>'required|exists:customers,id',
            'items'=>'required|array|min:1',
            'items.*.item_id'=>'required|exists:items,id',
            'items.*.qty'=>'required|integer|min:1',
            'items.*.rate'=>'required|numeric|min:0',
        ]);

        $order = new SalesOrder();
        $order->order_no = 'SO-'.time();
        $order->customer_id = $request->customer_id;
        $order->order_date = now();
        $order->status = 'pending';
        $order->total_amount = 0; 
        $order->save();

        $total = 0;

        foreach($request->items as $itemData){
            $amount = $itemData['qty'] * $itemData['rate'];
            $total += $amount;

            SalesOrderItem::create([
                'sales_order_id'=>$order->id,
                'item_id'=>$itemData['item_id'],
                'qty'=>$itemData['qty'],
                'rate'=>$itemData['rate'],
                'amount'=>$amount
            ]);
        }

        $order->total_amount = $total;
        $order->save();

        return redirect()->route('sales.orders')->with('success','Sales Order created.');
    }

  
    public function confirmOrder(Request $request, $id)
   
    {
        $orders = SalesOrder::with(['customer', 'items.item'])
            ->where('status', 'pending')
            ->get();

        return view('store_manager.pending', compact('orders'));
    }

     public function pendingOrders()
    {
        $orders = SalesOrder::with(['customer','items.item'])
                    ->where('status', 'pending')
                    ->get();

        return view('store_manager.pending', compact('orders'));
    }

    
    public function confirmedOrders()
    {
        $orders = SalesOrder::with(['customer','items.item'])
                    ->where('status', 'confirmed')
                    ->get();

        return view('store_manager.confirmed', compact('orders'));
    }
        public function rejectedOrders()
    {
        
        $orders = SalesOrder::where('status', 'rejected')->get();

        return view('store_manager.rejected', compact('orders'));
    }
    
    public function ajaxConfirmOrder(Request $request, $id)
    {
        $order = SalesOrder::with('items.item')->findOrFail($id);

        
        foreach ($order->items as $orderItem) {
            if ($orderItem->qty > $orderItem->item->stock) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Not enough stock for item: {$orderItem->item->item_name}"
                ]);
            }
        }

        
        foreach ($order->items as $orderItem) {
            $item = $orderItem->item;
            $item->stock -= $orderItem->qty;
            $item->save();
        }

        $order->status = 'confirmed';
        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Order confirmed successfully!'
        ]);
    }

    public function ajaxRejectOrder($id)
{
    $order = \App\Models\SalesOrder::findOrFail($id);
    $order->status = 'rejected';
    $order->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Order rejected successfully!'
    ]);
}
    
    
public function show($id)
{
    $order = \App\Models\SalesOrder::with('items.item', 'customer')->findOrFail($id);
    return view('store_manager.show', compact('order'));
}

public function showSalesOrder($id)
{
    $order = \App\Models\SalesOrder::with('items.item', 'customer')->findOrFail($id);
    return view('sales.show', compact('order'));
}

public function showItems()
    {
        $itemsList = \App\Models\Item::with('company')->get(); 
        return view('store_manager.inventory', compact('itemsList'));
    }

}