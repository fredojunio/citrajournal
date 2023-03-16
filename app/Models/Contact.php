<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'contacts';

    protected $fillable = [
        'id',
        'name',
        'type',
        'email',
        'address',
        'phone',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }
}
