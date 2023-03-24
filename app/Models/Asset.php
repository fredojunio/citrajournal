<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Asset extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'assets';

    protected $fillable = [
        'id',
        'purchase_id',
        'product_id',
        'date',
        'coa_id'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function coa()
    {
        return $this->belongTo(Coa::class, 'coa_id', 'id');
    }
}
