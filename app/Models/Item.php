<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_code',
        'item_name',
        'unit_of_measure',
        'opening_stock',
        'stock',
        'company_id'
    ];

     public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
