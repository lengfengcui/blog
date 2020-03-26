<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gory;
use App\Carts;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class ProinfoController extends Controller
{
    public function proinfo($id){
        //统计访问量
        // if(Cache::add('count_'.$id,1)){
        //     $count=Cache::get('count_'.$id);
        // }else{
        //     $count=Cache::increment('count'.$id);
        // }
        // $count=Cache::add('count_'.$id,1)?Cache::get('count_'.$id):Cache::increment('count'.$id);
        
        $count=Redis::setnx('count_'.$id,1)?Redis::get('count_'.$id):Redis::incr('count_'.$id);

    	$gory=Gory::find($id);
    	//dd($gory);
    	return view('index.proinfo',['gory'=>$gory,'count'=>$count]);
    }
    //添加购物车
     public function addcart(Request $request){
     	//判断用户有没有登录
     	$user=session('users');
     	if(!$user){
     		return json_encode(['code'=>'00003','msg'=>'用户未登录']);
     	}
    	$g_id=$request->g_id;
    	$buy_number=$request->buy_number;
    	//根据商品id查询商品信息
    	$gory=Gory::find($g_id);
    	//判断库存
    	if($gory->g_num<$buy_number){
    		return json_encode(['code'=>'00004','msg'=>'库存不足']);
    	}
    	//判断用户之前是否添加郭此商品，如果添加过则更改购买数量即可
    	$carts=Carts::where(['user_id'=>$user->user_id,'g_id'=>$g_id])->first();
    	//dd($carts);
    	if($carts){
    		//库存判断
    		$buy_number=$carts->buy_number+$buy_number;
    		if($gory->g_num<$buy_number){
    			$buy_number=$gory->g_num;
    		}
    		//更新购买数量
    		$res=Carts::where('cart_id',$carts->cart_id)->update(['buy_number'=>$buy_number]);
    	}else{


    	//添加入购物车
    	$data=[
    		'user_id'=>$user->user_id,
    		'g_id'=>$g_id,
    		'g_name'=>$gory->g_name,
    		'g_price'=>$gory->g_price,
    		'buy_number'=>$buy_number,
    		'g_logo'=>$gory->g_logo,
    		'addtime'=>time()
    	];
    	$res=Carts::create($data);
    }
    	if($res){
    		return json_encode(['code'=>'00000','msg'=>'添加成功']);
    	}
    }
}
