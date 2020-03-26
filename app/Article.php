<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //指定表名
    protected $table = 'article';
    protected $primaryKey = 't_id';
    public $timestamps = false;
    
    //黑名单
    protected $guarded = [];
}
