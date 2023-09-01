<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CarritoContoller extends Controller
{
    public function index2()
    {
        $productos = Product::orderBy('id', 'desc')->paginate(10);
        // var_dump($productos);
        return view('carrito.index', ['productos' => $productos]);
    }
    public function addToCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1); // Si no se especifica, la cantidad predeterminada es 1

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = session()->get('cart', []);

        // Verifica si ya existe el producto en el carrito
        if (isset($cart[$productId])) {
            // Incrementa la cantidad si ya existe
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Agrega el producto con la cantidad
            $cart[$productId] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    // Ver el contenido del carrito
    public function viewCart()
    {
        $cart = session()->get('cart', []);

        return view('carrito.cart.index', compact('cart'));
    }
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('quantities', []) as $productId => $quantity) {
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.viewCart')->with('success', 'Cart updated successfully.');
    }
}
