<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'purchase_details';

    protected $fillable = [
        'id',
        'purchase_id',
        'product_id',
        'description',
        'price',
        'quantity',
        'tax'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
