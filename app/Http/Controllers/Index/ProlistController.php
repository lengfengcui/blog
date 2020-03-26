<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gory;
class ProlistController extends Controller
{
     public function prolist(){
     	$gory=Gory::all();
     	//dd($gory);
    	return view('index.prolist',['gory'=>$gory]);
    }
}
