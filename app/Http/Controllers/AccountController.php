<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Admin;
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
    
    //Admin login
    public function adminLogin()
    {
        return view('admin.login.login');
    }
    public function handleAdminLogin(Request $req)
    {
        $this->validate($req,[
            'email'=>"required|email",
            'password'=>"required",
        ]);
        $email = Admin::where('email',$req->email)->first();
        // echo $email ; return ;
        if($email){
            $password = Admin::where('email',$req->email)->where('password',$req->password)->first();
            if($password){
                Session::put('admin','login admin success');
            }
            else{
                Session::put('loginFalse','Thông tin nhập chưa đúng');
            }
        }
        else{
            Session::put('loginFalse','Thông tin nhập chưa đúng');
        }
        return redirect()->route('dashboard');
    }
    public function logoutAdmin()
    {
        Session::forget('admin');
        return redirect()->route('adminLogin');
    }
}
