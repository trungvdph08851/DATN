<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(){
        $url = session('url');
        return view('Auth.login', compact('url'));
    }
    public function postLogin(Request $request){
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => "Hãy nhập tài khoản",
                'password.required' => "Hãy nhập mật khẩu"
            ]
            );
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])
            || Auth::attempt(['phone_number' => $request->email, 'password' => $request->password])){
                if ($request->url != "") {
                    return redirect('/' . $request->url);
                }
                return redirect()->route('admin.index');
        }else{
        return redirect()->back()->with('msg', "Sai thông tin đăng nhập");
        }
    }
}
