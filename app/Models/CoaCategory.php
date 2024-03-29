<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoaCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'coa_categories';

    protected $fillable = [
        'id',
        'name'
    ];

    public function coas()
    {
        return $this->hasMany(Coa::class, 'coa_id', 'id');
    }
}
