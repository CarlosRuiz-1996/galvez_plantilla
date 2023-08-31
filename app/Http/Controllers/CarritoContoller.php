<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CarritoContoller extends Controller
{
    public function index()
    {
        $productos = Product::orderBy('id', 'desc')->paginate(10);
        // var_dump($productos);
        return view('carrito.index', ['productos' => $productos]);
    }  
}
