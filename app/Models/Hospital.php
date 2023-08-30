<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitals';

    // relacion One to Many
    public function pedidos(){
        // llamo a otro modelo
        return $this->hasMany('App\Models\Order');
    }

}
