<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'sales';

    protected $fillable = [
        'id',
        'contact_id',
        'invoice',
        'status',
        'total',
        'remaining_bill',
        'date',
        'due_date',
        'kas_id'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function kas()
    {
        return $this->belongsTo(Kas::class, 'kas_id', 'id');
    }
}
