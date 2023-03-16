<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'costs';

    protected $fillable = [
        'id',
        'contact_id',
        'description',
        'price',
        'tax',
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
}
