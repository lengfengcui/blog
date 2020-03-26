<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login(){
    	return view('login');
    }
    public function logindo(){
    	$post=request()->except('_token');



    	$adminuser=Admin::where('admin_name',$post['admin_name'])->first();
    	if(decrypt($adminuser->admin_pwd)!=$post['admin_pwd']){
    		return redirect('/login')->with('msg','用户名或者密码错误');
    	}
    	
            if(isset($post['rember'])){
                //走七天免登录 把用户信息存入cookie
                Cookie::queue('adminuser',$adminuser,7*24*60);
            }
    		session(['adminuser'=>$adminuser]);
    		return redirect('/login/index');
    
    }
    public function index(){
    	return view('admin');
    }
}
