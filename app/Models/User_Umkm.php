<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Umkm extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'user_umkm';

    protected $fillable = [
        'id',
        'user_id',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }
}
