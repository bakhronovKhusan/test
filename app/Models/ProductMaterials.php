<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMaterials extends Model
{
    use HasFactory;

    protected $table = 'product_materials';

    protected $fillable = [
        'material_id',
        'product_id',
        'quantity',
    ];

    public function product() {
        return $this->belongsTo(Products::class,'product_id');
    }

    public function material() {
        return $this->belongsTo(Materials::class,'material_id');
    }
}
