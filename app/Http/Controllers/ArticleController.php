<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $t_title=request()->t_title;
        $where=[];
        if($t_title){
            $where[]=['t_title','like',"%$t_title%"];
        }
        $pageSize=config('app.pageSize');
        $article=Article::where($where)->paginate($pageSize);
        $query=request()->all();
        return view('article/index',['article'=>$article,'query'=>$query]);
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
        return view('article.create',['cate'=>$cate]);
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
        //dump($post);
        $post['t_time']=time();
        //文件上传
    
        $validatedData = $request->validate([ 
            't_title' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:article',
            'cate_id'=>'required',
            't_yao'=>'required',
            't_name'=>'required',
            't_email'=>'required',
            't_zi'=>'required',
            
        ],[
            't_title.regex'=>'文章标题是中文字母数字下划线',
            't_title.unique'=>'文章名称已存在',
            't_title.required'=>'文章标题必填',
            'cate_id.required'=>'分类必填',
            't_yao.required'=>'文章重要性必填',
            't_name.required'=>'作者名称必填',
            't_email.required'=>'作者email必填',
            't_zi.required'=>'必填',

        ]);

        if($request->hasFile('t_logo')) { 
             $post['t_logo']=upload('t_logo');
          }
        $res=Article::insert($post);
        //dd($res);
        if($res){
        return redirect('/article/index');
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
       $article=Article::where('t_id',$id)->first();
       //dd($article);
        //  //分类
        $cate=Category::all();
        //dd($cate);
        // //无限极分类
        $cate=CreateTree($cate);
        //dd($cate);
        return view('article.edit',['article'=>$article,'cate'=>$cate]);
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
        $post=$request->except('_token');
        //dump($post);
        $post['t_time']=time();
        //文件上传
    
        $validatedData = $request->validate([ 
            't_title' => 'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:article',
            'cate_id'=>'required',
            't_yao'=>'required',
            't_name'=>'required',
            't_email'=>'required',
            't_zi'=>'required',
            
        ],[
            't_title.regex'=>'文章标题是中文字母数字下划线',
            't_title.unique'=>'文章名称已存在',
            't_title.required'=>'文章标题必填',
            'cate_id.required'=>'分类必填',
            't_yao.required'=>'文章重要性必填',
            't_name.required'=>'作者名称必填',
            't_email.required'=>'作者email必填',
            't_zi.required'=>'必填',

        ]);

        if($request->hasFile('t_logo')) { 
             $post['t_logo']=upload('t_logo');
          }
        $res=Article::where('t_id',$id)->update($post);
        //dd($res);
        if($res!==false){
        return redirect('/article/index');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Article::destroy($id);
        if($res){
            if(request()->ajax()){
                return json_encode(['code'=>'00000','msg'=>'删除成功']);
            }
            return redirect('/article/index');
        }
    }
}
