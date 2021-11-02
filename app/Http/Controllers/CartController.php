<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Unit;
use App\Models\Order;



class CartController extends Controller
{
    public function addToCart(Request $request){

        // dd($request->all());
        $prod = Product::find($request->p_id);
        $unit = Unit::find($prod->unit_id);
        $sup = User::role('Supplier')->find($request->s_id);


        $cart = new Cart();
        $cart->customer_id = auth()->user()->id;
        $cart->product_id = $prod->id;
        $cart->supplier_id = $sup->id;
        $cart->price = $prod->price;
        $cart->qty = $request->qty;
        $cart->total = $request->total;
        $cart->unit = $unit->name;
        $cart->min_qty = $request->qty1;

        $cart->save();

        $response = [
            'data' => $request->s_id,

        ];

       return response(json_encode($response));




    }


    public function confirmOrder(Request $request){

        
        $sup = User::role('Supplier')->find($request->id);

        $c = Cart::where('supplier_id',$sup->id)->get();
        $total = 0;
        $qty = [];
        $min_qty = [];
        $product_ids = [];
        foreach($c as $data){
            $total = $total + $data->total;
           
            array_push($qty,$data->qty);
            array_push($min_qty,$data->min_qty);

            array_push($product_ids,$data->product_id);
        }





        $order = new Order();
        $order->order_number = rand(456788,100000000);
        $order->customer_id = auth()->user()->id;
        $order->product_id = json_encode($product_ids);
        $order->supplier_id = $sup->id;

        $order->qty = json_encode($qty);
        $order->min_qty = json_encode($min_qty);

        $order->total = $total;

        $order->save();

        foreach($c as $data){
            $data->delete();
        }


        $response = [
            'data' => $order->order_number
        ];

       return response(json_encode($response));




    }

    public function removeItem($id){
        Cart::find($id)->delete();

        return back()->with('success','Item deleted from cart');
    }
}
