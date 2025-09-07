<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    protected $fillable = [
        'sales_order_id', 'item_id', 'qty', 'rate', 'amount'
    ];

    
    public function order()
    {
        return $this->belongsTo(SalesOrder::class, 'sales_order_id');
    }

   
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
