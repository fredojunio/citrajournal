<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'description',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }

    public function sale()
    {
        return $this->hasOne(ProductSale::class, 'product_id', 'id');
    }

    public function purchase()
    {
        return $this->hasOne(ProductPurchase::class, 'product_id', 'id');
    }

    public function stock()
    {
        return $this->hasOne(ProductStock::class, 'product_id', 'id');
    }
}
