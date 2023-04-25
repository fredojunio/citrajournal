<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'transaction_details';

    protected $fillable = [
        'id',
        'transaction_id',
        'product_id',
        'description',
        'price',
        'quantity',
        'tax',
        'coa_id',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coa_id', 'id');
    }

    public function paid()
    {
        return $this->belongsTo(Transaction::class, 'paid_id', 'id');
    }
}
