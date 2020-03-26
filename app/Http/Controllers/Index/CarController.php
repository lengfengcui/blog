<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carts;
class CarController extends Controller
{
     public function car(){
 		$user_id=session('users')->user_id;
     	$carts=Carts::where('user_id',$user_id)->get();
     	//dd($carts);
     	$buy_number=array_column($carts->toArray(),'buy_number');
     	//dd($buy_number); 
     	$cart_id=array_column($carts->toArray(),'cart_id');
     	//dd($cart_id);
    	return view('index.car',['carts'=>$carts,'buy_number'=>$buy_number,'cart_id'=>$cart_id]);
    }
}
