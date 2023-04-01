<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'product_purchases';

    protected $fillable = [
        'id',
        'product_id',
        'coa_id',
        'price',
        'tax'
    ];

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coa_id', 'id');
    }
}
