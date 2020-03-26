<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leng;
class LengController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leng=Leng::get();
        //dd($leng);
        return view('leng.index',['leng'=>$leng]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leng.create');
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
         if ($request->hasFile('clogo')) { 
            $post['clogo']=$this->upload('clogo');
        }
         //多文件上传
        if ($request->hasFile('cimgs')) { 
            $cimgs=$this->Moreupload('cimgs');
            $post['cimgs']=implode('|',$cimgs);
        }
         $res=Leng::insert($post);

       if($res){
        return redirect('/leng/index');
       }
    }
    
   //文件上传
    public function upload($img){
        //接收文件
            $file=request()->$img;
        //判断上传过程中有误错误
        if($file->isValid()){
            $store_result = $file->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
       }
        //多文件上传
    public function Moreupload($img){
         //接收文件
            $file=request()->$img;
        foreach($file as $k=>$v){
            if($v->isValid()){
                $store_result[$k] = $v->store('uploads');
            }else{
                 $store_result[$k] = '未获取到上传文件或上传过程出错';
            }
            
        }
         return $store_result;
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
