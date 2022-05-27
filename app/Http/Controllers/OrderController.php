<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetail;


class OrderController extends Controller
{
    public function list()
    {
        $all = Order::orderBy('id','desc')->paginate(5);
        return view('admin.order.list',compact('all'));
    }
    public function order_detail($id)
    {
        $shipping = Shipping::where('order_id',$id)->get();
        $product = OrderDetail::where('order_id',$id)->get();
        $priceOrder = Order::where('id',$id)->value('money');
        return view('admin.order.order_detail',compact('shipping','product','priceOrder'));
    }
}
