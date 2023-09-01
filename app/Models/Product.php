<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'grammage_id',
        'presentation_id',
        'brand_id',
        'price',
        'iva_id',
        'ieps_id',
        'total',
        'stock',
        // Agrega aquí otros campos que desees que sean asignables en masa
    ];
    public function grammage()
    {
        return $this->belongsTo(Grammage::class);
    }
    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function iva(){
        return $this->belongsTo(Iva::class);

    }
    public function ieps (){
        return $this->belongsTo(Ieps::class);

    }
}
