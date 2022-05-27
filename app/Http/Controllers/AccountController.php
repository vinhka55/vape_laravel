<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AccountController extends Controller
{
    public function login()
    {
        return view('user.account.login');
    }
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->pass);
        $user->save();
        Session::put('register_success','Đăng kí thành công, hãy đăng nhập ngay và mua sắm');
        return view('user.account.login');
    }
    public function handle_login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return view('user.home.home');
        }
        else{
            Session::put('login_false','Thông tin bạn nhập là sai!');
            return view('user.account.login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return view('user.home.home');
    }
    public function profile()
    {
        $order = Order::where('customer_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('user.account.profile',compact('order'));
    }
}
