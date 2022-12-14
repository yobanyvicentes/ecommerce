<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use Illuminate\Support\Facades\DB;


/**
 * Class OrderApiController
 * @package App\Http\Controllers
 */
class OrderApiController extends Controller
{
    public function index() {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function store(Request $request) {

        try {
            $this->validate($request, [
                'email' => 'required|string|max:100',
            ]);

            $correo = $request->email;

            $order = Order::create([
              "email_asociado" => $request->email,
            ]);

            //importante para recorrer arreglos de objetos:
            $a = json_encode($request->products);
            $datos = json_decode($a);
            $correoid = Order::where('email_asociado', $correo)->max('id');

            foreach($datos as $fila) {
                $orderproduct = OrderProduct::create([
                    'order_id' => $correoid,
                    'product_id' => $fila->id,
                    'quantity' => $fila->quantity,
                ]);

            }

            return response()->json($datos, 200);

        } catch (\Throwable $th) {
            return response()->json($th, 404);
        }

        return response()->json(['resultado' => 'creación exitosa de la orden', 'order' => $order , 'asignaciones' => $orderproduct], 200);
    }

    public function indexemail($email_asociado){
        $orders = array();
        $orders = DB::table('orders')->where('email_asociado', $email_asociado)->pluck('id');
        $orderprodusts = array();
        $allorders = array();
        $allorders[] = $email_asociado;

        foreach ($orders as $order) {
            $orderprodusts = DB::table('order_products')->where('order_id', $order)->get();
            foreach ($orderprodusts as $i) {
                $allorders[] = $i;
            }
        }

        return $allorders;
    }
}
