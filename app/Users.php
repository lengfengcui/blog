<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //指定表名
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
    //黑名单
    protected $guarded = [];
}
