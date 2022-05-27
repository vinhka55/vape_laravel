<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use DB;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $provincial = DB::table('devvn_tinhthanhpho')->get();
        return view('user.checkout.pageCheckout',compact('provincial'));
    }
    public function success(Request $request)
    {
        // info address 
        $ward = DB::table('devvn_xaphuongthitran')->where('xaid',$request->ward)->value('name');
        $district = DB::table('devvn_quanhuyen')->where('maqh',$request->district)->value('name');
        $provincial = DB::table('devvn_tinhthanhpho')->where('matp',$request->provincial)->value('name');

        $order_code=$request->order_code;
        //save order
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $order =  new Order;
        $order->order_code = $order_code;
        $order->money = $request->total_money;
        if($time->day < 10){
            $day = '0'.$time->day;
        }
        else{
            $day = $time->day;
        }

        if($time->month < 10){
            $month = '0'.$time->month;
        }
        else{
            $month = $time->month;
        }

        if($time->hour < 10){
            $hour = '0'.$time->hour;
        }
        else{
            $hour = $time->hour;
        }

        if($time->minute < 10){
            $minute = '0'.$time->minute;
        }
        else{
            $minute = $time->minute;
        }

        $order->time = $day.'-'.$month.'-'.$time->year.' '.$hour.'h '.$minute.'m';
        if(Auth::check()){
            $order->customer_id = Auth::user()->id;
        }
        $order->save();

        // save info shipping
        $shipping = new Shipping;
        $shipping->name = $request->fullName;
        $shipping->email = $request->email;
        $shipping->phone = $request->phone;
        $shipping->address = $request->detail_address.', '.$ward.', '.$district.', '.$provincial;
        $shipping->note = $request->note;
        $shipping->method = $request->method_pay;
        $shipping->order_id = $order->id;
        Session::put('shipping',$shipping);
        $shipping->save();

        //save order detail
        $cart = Session::get('cart');
        foreach ($cart as $key => $value) {
            $order_detail = new OrderDetail;
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $value['id'];
            $order_detail->product_image = $value['image'];
            $order_detail->product_name = $value['name'];
            $order_detail->product_price = $value['price'];
            $order_detail->product_qty = $value['qty'];
            $order_detail->save();
        }
        Session::put('cart',[]);
        return view('user.checkout.success',compact('order_code'));
    }
}
