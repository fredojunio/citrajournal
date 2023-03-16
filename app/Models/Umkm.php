<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'umkms';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'type',
        'employees',
        'user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
