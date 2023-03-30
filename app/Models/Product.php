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
        'coa_id',
        'harga_beli',
        'pajak_beli',
        'harga_jual',
        'pajak_jual',
        'umkm_id',
    ];

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coa-id', 'id');
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }
}
