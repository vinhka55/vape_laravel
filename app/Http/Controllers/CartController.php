<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function show(Request $request){
        // Session::flush('cart');
        if(!Session::has('cart')){
            Session::put('cart',[]);
        }
        $cart = Session::get('cart');
        if($request->all()!=null){
            $oneProduct = [
                'id'=>$request->id,
                'image'=>$request->image,
                'name'=>$request->name,
                'price'=>$request->price,
                'qty'=>1,
            ];
            $hasProduct=false;
            if(count($cart)>0){
                foreach ($cart as &$item) {
                    if($item['id']==$oneProduct['id']){
                        $hasProduct=true;
                        $item['qty'] =  $item['qty'] + 1;
                    }
                }
            }
            if($hasProduct==false){
                array_push($cart,$oneProduct);
            }
        }
        Session::put('cart',$cart); 
        $output = '';    
        if(Session::get('cart')){      
            foreach (Session::get('cart') as $pro) {
                $output .= '<tr id="product-in-cart-'.$pro['id'].'">';
                $output .= '<td>'.$pro['image'].'</td>';
                $output .= '<td>'.$pro['name'].'</td>';
                $output .= '<td>'.number_format($pro['price']).'</td>';
                $output .= '<td>'.$pro['qty'].'</td>';
                $output .= '<td>'.number_format($pro['qty']*$pro['price']).'</td>';         
                $output .= '<td><button onclick="delete_product_in_cart('.$pro['id'].')">Xóa</button></td>';   
                $output .= '</tr>';      
            }
        }       
        return $output;
    }
    public function delete_product(Request $request)
    {
        $cart = Session::get('cart');
        for($i=0;$i<count($cart);$i++){
            if($cart[$i]['id']==$request->idProduct){
                unset($cart[$i]);
            }
        }
        Session::put('cart',$cart);
    }
    public function countItemCart()
    {
        if(!Session::get('cart')) return 0;
        $itemCart = count(Session::get('cart'));
        return $itemCart;
    }
} 
