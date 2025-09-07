<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;

class SalesOrderSeeder extends Seeder
{
    public function run(): void
    {
        // Example order
        $order = SalesOrder::create([
            'order_no' => 'SO-'.time(),
            'customer_id' => 1, // John Doe
            'order_date' => now(),
            'status' => 'pending',
            'company_id' => 1,
            'total_amount' => 0
        ]);

        // Example items (make sure you have items in items table)
        $items = [
            ['item_id'=>1, 'qty'=>2, 'rate'=>100],
            ['item_id'=>2, 'qty'=>1, 'rate'=>150],
        ];

        $total = 0;
        foreach($items as $i){
            $amount = $i['qty'] * $i['rate'];
            $total += $amount;

            SalesOrderItem::create([
                'sales_order_id'=>$order->id,
                'item_id'=>$i['item_id'],
                'qty'=>$i['qty'],
                'rate'=>$i['rate'],
                'amount'=>$amount
            ]);
        }

        $order->total_amount = $total;
        $order->save();
    }
}
