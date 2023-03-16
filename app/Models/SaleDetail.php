<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'sale_details';

    protected $fillable = [
        'id',
        'sale_id',
        'product_id',
        'description',
        'price',
        'quantity',
        'tax'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
