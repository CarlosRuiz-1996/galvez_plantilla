<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categories;
use App\Models\Detail;
use App\Models\Grammage;
use App\Models\Hospital;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoContoller extends Controller
{
    public function index2()
    {
        $marcas = Brand::all();
        $gramajes = Grammage::all();
        $categorias = Categories::all();
        $productos = Product::orderBy('id', 'desc')->paginate(4);
        $cart = session()->get('cart', []);
        // var_dump($productos);
        return view('carrito.index', compact('cart','productos','categorias','gramajes','marcas'));
    }  

    public function addToCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity', 1); // Si no se especifica, la cantidad predeterminada es 1

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = session()->get('cart', []);
        // Verifica si hay stock
        if ($quantity <= $product->stock) {
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
        } else {
            return redirect()->back()->with('error', 'Stock insuficiente.');
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

    public function dropsession()
    {
        // Borra la sesión del carrito
        session()->forget('cart');
        session()->forget('cartTotal');
    }
    // Ver el contenido del carrito
    public function viewCart(Request $request)
    {
        $user = auth()->user();
        $hospitalId = $user->hospitals[0]->id;
        $query = Order::orderBy('id', 'desc');
            $query->where('hospital_id',$hospitalId);
    
        if ($request->filled('filter_date')) {
            $query->whereDate('created_at', $request->input('filter_date'));
        } 
        $pedidos = $query->paginate(10);
        return view('carrito.cart.index', compact('pedidos'));
    }

    public function updateCart($id, $accion)
    {
        $cart = session()->get('cart', []);

        if ($id !== null && $accion !== null) {
            if (isset($cart[$id])) {
                $product = Product::find($id);
                if ($product) {
                    if ($accion === 'increase') {
                        // Verifica si la cantidad deseada es menor o igual al stock disponible
                        if ($cart[$id]['quantity'] + 1 <= $product->stock) {
                            $cart[$id]['quantity'] += 1;
                        } else {
                            return redirect()->back()->with('error', 'Stock insuficiente para aumentar la cantidad.');
                        }
                    } elseif ($accion === 'decrease' && $cart[$id]['quantity'] > 1) {
                        $cart[$id]['quantity'] -= 1;
                    }

                    session()->put('cart', $cart);
                }
            }
        }
        $this->total($cart);

       
        return redirect()->route('carrito.carrito')->with('success', 'Cart updated successfully.');
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
            return redirect()->route('carrito.carrito')->with('status', 'Producto eliminado del carrito exitosamente.');
        } else {
            // Si el producto no existe en el carrito, puedes manejarlo según tus necesidades
            return redirect()->route('carrito.carrito')->with('error', 'El producto no se encontraba en el carrito.');
        }
    }


    public function generarPedido2(Request $request)
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


    public function generarPedido(Request $request)
    {
        // Obtén los datos necesarios para la orden desde el formulario
        // $total = $request->input('total');
        $fecha_entrega = $request->input('entrega');
        $message = $request->input('message');

        // Accede al ID del hospital relacionado con el usuario
        $user = auth()->user();

        $hospitalId = $user->hospitals[0]->id;

        // Otras columnas de la tabla Orders que necesites

        // Crea la orden
        $order = new Order();
        $order->hospital_id = $hospitalId;
        $order->deadline = $fecha_entrega;
        $order->observations = $message;
        $order->status = 1;
        $order->total = session('cartTotal');



        $order->save();

        // Obtén los datos del carrito de la sesión
        $cart = session()->get('cart', []);

        // Guardar los detalles de la orden en la tabla Detail
        foreach ($cart as $productId => $item) {
            $detail = new Detail();
            $detail->order_id = $order->id; // Asocia el detalle con la orden creada anteriormente
            $detail->product_id = $productId;
            $detail->amount = $item['quantity'];
            $detail->save();

            // Actualizar el stock del producto
            $product = Product::find($productId);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->update();
            }
        }

        $this->dropsession();

        return view('dashboard')->with('status', 'Orden creada exitosamente.');
    }
}
