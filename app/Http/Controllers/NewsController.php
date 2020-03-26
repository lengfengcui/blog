<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Category;
use Illuminate\Support\Facades\Redis;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // //存储session
        //  session(['name'=>'zhangsan']);
        //  request()->session()->put('number',100);

        // //删除
        // //session(['name'=>null]);
        // //request()->session()->forget('number');
        
        //  //删除所有
        // //request()->session()->flush();


        // //获取session
        // echo session('name');
        // //echo request()->session()->get('number');
        // //获取所有
        //  dump(request()->session()->all());
        //Redis::flushall();
        $page=request()->page??'';
        //echo $page;
        $new_title=request()->new_title;
       
        $news=Redis::get('newslist_'.$page.'_'.$new_title);
         //dd($news);
        if(!$news){
            //echo "DB=====";
        

        
        $where=[];
        if($new_title){
            $where[]=['new_title','like',"%$new_title%"];
        }
         $new_author=request()->new_author;
        if($new_author){
            $where[]=['new_author','like',"%$new_author%"];
        }

        $pageSize=config('app.pageSize');
        $news=News::where($where)->paginate($pageSize);
        //dd($news);
        $news=serialize($news);
        Redis::setex('newslist_'.$page.'_'.$new_title,5*60,$news);
        }
        $news=unserialize($news);
         $query=request()->all();

         // //Ajax分页
         // if(request()->ajax()){
         //      return view('news.ajaxpage',['news'=>$news]);
         // }
        return view('news.index',['news'=>$news,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类
        $cate=Category::all();
        //dd($cate);
        //无限极分类
        $cate=CreateTree($cate);
        //dd($cate);
        return view('news.create',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=$request->except('_token');
        //dd($post);
         $post['new_time']=time();
         $validatedData = $request->validate([
            'new_title' => 'required|regex:/^[\x{4e00}-\x{9fa5}w]{2,30}$/u|unique:news|max:20',
            'new_author'=>'required',
            ],
            [
                'new_title.regex'=>'长度为2-30位，需是中文、字母、数字、下划线组成',
                'new_title.required'=>'新闻必填！',
                'new_title.unique'=>'新闻名称已存在',
                'new_author.required'=>'新闻作者必填！',
        ]);
        $res=News::insert($post);
        //dd($res);
        if($res){
            return redirect('/news/index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
