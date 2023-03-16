<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'kass';

    protected $fillable = [
        'id',
        'coa_id',
        'date',
        'tax',
        'balance',
        'umkm_id',
        'contact_id',
    ];

    public function coa()
    {
        return $this->belongsTo(Coa::class, 'coa_id', 'id');
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
