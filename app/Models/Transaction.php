<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'contact_id',
        'invoice',
        'status',
        'total',
        'remaining_bill',
        'date',
        'due_date',
        'category_id',
        'kas_id',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function kas()
    {
        return $this->belongsTo(Kas::class, 'kas_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'id', 'transaction_id');
    }
}
