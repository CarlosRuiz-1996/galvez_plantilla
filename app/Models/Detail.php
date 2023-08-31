<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'Detail';

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'created_at',
        'updated_at',
        // otros campos permitidos en masa
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function detalles()
    {
        return $this->hasMany(Detail::class);
    }
}
