<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'transaction_categories';

    protected $fillable = [
        'id',
        'name'
    ];
}
