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
}
