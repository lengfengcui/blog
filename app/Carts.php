<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    //指定表名
    protected $table = 'carts';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    
    //黑名单
    protected $guarded = [];
}
