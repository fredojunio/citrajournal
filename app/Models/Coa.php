<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'coas';

    protected $fillable = [
        'id',
        'code',
        'name',
        'category_id',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(CoaCategory::class, 'category_id', 'id');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'coa_transaction', 'coa_id', 'transaction_id');
    }

    public function coa_transactions()
    {
        return $this->hasMany(Coa_Transaction::class, 'coa_id', 'id');
    }

    public function balance()
    {
        $coa_transactions = $this->hasMany(Coa_Transaction::class, 'coa_id', 'id');
        $credit = $coa_transactions->sum('credit');
        $debit = $coa_transactions->sum('debit');
        $balance = $debit - $credit;
        if ($balance < 0) {
            $balance = - ($balance);
        }

        return $balance;
    }
}
