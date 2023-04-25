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
        'cut',
        'taxtotal',
        'subtotal',
        'cuttotal',
        'date',
        'due_date',
        'category_id',
        'umkm_id',
        'paid_id'
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function coa()
    {
        $coa_transaction = $this->hasMany(Coa_Transaction::class, 'transaction_id', 'id')
            ->orderByDesc('id')
            ->first();
        return $coa_transaction->coa();
    }

    public function paid()
    {
        return $this->belongsTo(Transaction::class, 'paid_id', 'id');
    }
}
