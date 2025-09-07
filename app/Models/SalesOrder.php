<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'order_no',
        'customer_id',
        'order_date',
        'status',
        'company_id',
        'total_amount',
    ];

    
    public function items()
    {
        return $this->hasMany(SalesOrderItem::class, 'sales_order_id');
    }

    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
