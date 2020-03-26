<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gory;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
    	//先去缓存读取数据
    	//Cache::flush();
    	//Redis::flushall();
    	 //$gory=Cache::get('g_show');
    	 //$gory=cache('g_show');
    	$gory=Redis::get('g_show');
    	//dump($gory);
    	if(!$gory){
    	 	//echo "DB=====";
    		//如果缓存没有则读取数据库
	    	$gory=Gory::getShowData();
	    	//dd($gory);
	    	//dd($gory);
	    	
	    	//存入memcache
	     	//Cache::put('g_show',$gory,60*60*24);
	     	//cache(['g_show'=>$gory],60*60*24);
	     	$gory=serialize($gory);
	     	Redis::setex('g_show',60*60*24,$gory);
    	 }
    	 $gory=unserialize($gory);
    	 //dd($gory);
    	$gorya=Gory::where('g_new',1)->take(4)->get();
    	$goryb=Gory::where('g_fine',1)->take(4)->get();
    	$cate=Category::where('parent_id',0)->get();
    	
    	return view('index.index',['gory'=>$gory,'gorya'=>$gorya,'goryb'=>$gorya,'cate'=>$cate]);
    }
}
