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

    public function currentBalance()
    {
        $coa_transactions = Coa_Transaction::where('coa_id', $this->coa_id)
            ->whereHas('transaction', function ($q) {
                $q->where('date', '<=', $this->transaction->date)
                    ->where('created_at', '<=', $this->transaction->created_at);
            })
            ->get();

        $balance = 0;
        foreach ($coa_transactions as $ct) {
            $balance += $ct->debit;
            $balance -= $ct->credit;
        }
        if ($balance < 0) {
            $balance = - ($balance);
        }

        return $balance;
    }
}
