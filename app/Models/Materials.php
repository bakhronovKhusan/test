<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;

    protected $table = 'materials';

    protected $fillable = [
        'name',
    ];

    public function warehouse() {
        return $this->hasMany(Warehouses::class, 'material_id');
    }

    public function product_material() {
        return $this->hasMany(ProductMaterials::class, 'material_id');
    }
}
