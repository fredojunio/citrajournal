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
        'category',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }
}
