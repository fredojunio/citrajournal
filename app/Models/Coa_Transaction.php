<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa_Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'coa_transaction';

    protected $fillable = [
        'id',
        'transaction_id',
        'coa_id',
        'credit',
        'debit',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coa_id', 'id');
    }
}
