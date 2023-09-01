<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $this->total($cart);
        return redirect()->back()->with('status', 'Producto agregado.');
    }
    public function total($cart)
    {
        // Recalcula el total del carrito
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['product']->total * $item['quantity'];
            session()->put('cartTotal', $total);
        }
    }
    // Ver el contenido del carrito
    public function viewCart()
    {
        $cart = session()->get('cart', []);

        return view('carrito.cart.index', compact('cart'));
    }


    public function updateCart($id, $accion)
    {
        $cart = session()->get('cart', []);

        if ($id !== null && $accion !== null) {
            if (isset($cart[$id])) {
                if ($accion === 'increase') {
                    $cart[$id]['quantity'] += 1;
                } elseif ($accion === 'decrease' && $cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity'] -= 1;
                }

                session()->put('cart', $cart);
            }
        }
        $this->total($cart);

        return redirect()->route('cart.viewCart')->with('success', 'Cart updated successfully.');
    }


    public function removeProduct($productId)
    {
        // Obtener el carrito actual de la sesión
        $cart = session()->get('cart', []);

        // Verificar si el producto existe en el carrito
        if (isset($cart[$productId])) {
            // Eliminar el producto del carrito
            unset($cart[$productId]);

            // Actualizar el carrito en la sesión
            session()->put('cart', $cart);

            $this->total($cart);
            // Puedes redirigir al usuario de vuelta al carrito o a donde desees
            return redirect()->route('cart.viewCart')->with('status', 'Producto eliminado del carrito exitosamente.');
        } else {
            // Si el producto no existe en el carrito, puedes manejarlo según tus necesidades
            return redirect()->route('cart.viewCart')->with('error', 'El producto no se encontraba en el carrito.');
        }
    }


    public function generarPedido(Request $request)
    {
        $cart = session()->get('cart', []);

        // Verifica si el carrito está vacío
        if (empty($cart)) {
            return redirect()->route('cart.viewCart')->with('error', 'El carrito está vacío. Agrega productos antes de generar un pedido.');
        }

        // Crea un nuevo pedido
        $pedido = new Order();
        $pedido->user_id = auth()->user()->id; // Si estás utilizando autenticación
        // Otros campos del pedido, como dirección de envío, método de pago, etc.
        $pedido->save();

        // Asocia los productos del carrito con el pedido
        foreach ($cart as $productId => $productData) {
            $producto = Product::find($productId);

            // Verifica si el producto existe y tiene suficiente stock
            if (!$producto || $producto->stock < $productData['quantity']) {
                // Si el producto no existe o no hay suficiente stock, puedes manejarlo según tu lógica (por ejemplo, quitar el producto del carrito).
                continue;
            }

            // Asocia el producto con el pedido y guarda los detalles del pedido
            $pedido->productos()->attach($productId, ['quantity' => $productData['quantity']]);
        }

        // Limpia el carrito después de generar el pedido
        session()->forget('cart');

        // Redirige al usuario a una página de confirmación o a donde desees
        return redirect()->route('cart.viewCart')->with('success', 'Pedido generado exitosamente. ¡Gracias por tu compra!');
    }
}
