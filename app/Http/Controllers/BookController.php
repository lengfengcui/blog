<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $shu=request()->shu;
        $where=[];
        if($shu){
            $where[]=['book_shu','like',"%$shu%"];
        }
        $name=request()->name;
        if($name){
            $where[]=['book_name','like',"%$name%"];
        }
        $query=request()->all();
        $pageSize=config('app.pageSize');
        $book=Book::where($where)->paginate($pageSize);
        return view('book.index',['book'=>$book,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
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
        $validatedData = $request->validate([ 
            'book_shu' => 'required|unique:book|max:20', 
            'book_name' => 'required', 
        ],[
            'book_shu.required'=>'书名必填！',
            'book_shu.unique'=>'书名已存在！',
            'book_shu.max'=>'书名长度为2-15位！',
            'book_shu.not_regex'=>'需是中文、字母、数字、下划线组成！',
            'book_name.required'=>'作者必填！',
        ]);
        //文件上传
        if($request->hasFile('book_logo')){
            $post['book_logo']=$this->upload('book_logo');
        }
        

        $res=Book::insert($post);
        //dd($res);
        if($res){
            return redirect('/book/index');
        }
    }
    public function upload($img){
        //接收文件
        $file=request()->$img;
        //判断上传过程中是否有误
        if($file->isValid()){
            $store_result=$file->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
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
