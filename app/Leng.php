<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leng extends Model
{
    //指定表名
    protected $table = 'leng';
    protected $primaryKey = 'cid';
    public $timestamps = false;
    
    //黑名单
    protected $guarded = [];
}
