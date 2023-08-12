<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouses extends Model
{
    use HasFactory;

    protected $table = 'warehouses';

    protected $fillable = [
        'id',
        'material_id',
        'remainder',
        'price',
    ];

    public function material() {
        return $this->belongsTo(Materials::class,'material_id');
    }
}
