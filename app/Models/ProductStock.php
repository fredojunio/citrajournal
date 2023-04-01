<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'product_stocks';

    protected $fillable = [
        'id',
        'product_id',
        'coa_id',
        'stock',
    ];

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coa_id', 'id');
    }
}
