<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;


class OrderController extends Controller
{
    protected $view='orders';
    public function index()
    {
       $view=$this->view;
       $orders=Order::where('supplier_id',auth()->user()->id)->paginate(1);
       return view('mycomponent.datatable', compact('orders','view'));
    }

    public function updateStatus(Request $request)
    {
        // dd($request->status);
        Order::where('id',$request->order_id)->update([
            'status'=>$request->status
        ]);
        
        //return trans('message.Success_updated');

    }
    public function updateQuantity(Request $request)
    {
        Order::where('id',$request->order_id)->update([
            'shipped_with_min_qty'=>$request->req_min_qty
        ]);

      return back();

    }
}
