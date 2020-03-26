<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gory extends Model
{
    //指定表名
    protected $table = 'gory';
    protected $primaryKey = 'g_id';
    public $timestamps = false;
    
    //黑名单
    protected $guarded = [];

    public static function getShowData(){
    	$gory=Gory::where('g_show',1)->take(4)->get();
    	
    	return $gory;
    } 
}
