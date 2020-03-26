<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin=Admin::all();
        return view('admin.index',['admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
       $post['admin_pwd']=encrypt($post['admin_pwd']);
       $validatedData = $request->validate([
            'admin_name' => 'regex:/^[\x{4e00}-\x{9fa5}w]{2,50}$/u|unique:admin|max:20',
            'admin_tel'=>'digits_between:10,11',
            'admin_pwd'=>'digits_between:6,20',
            'admin_email' => 'required', 
            ],
            [
                'admin_email.required'=>'邮箱必填！',
                'admin_name.regex'=>'管理员名称位数',
                'admin_name.unique'=>'管理名称已存在',
                'admin_pwd.digits_between'=>'密码不能少于6位',
                'admin_tel.digits_between'=>'手机号11位',
        ]);
        if ($request->hasFile('admin_logo')) { 
            $post['admin_logo']=upload('admin_logo');
        }
        $res=Admin::insert($post);
        //dd($res);
        if($res){
        return redirect('/admin/index');
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
        $admin=Admin::where('admin_id',$id)->first();

        return view('admin.edit',['admin'=>$admin]);
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
        //排除接收谁
       $post=$request->except(['_token']);
       if ($request->hasFile('admin_logo')) { 
            $post['admin_logo']=upload('admin_logo');
        }
       $res=Admin::where('admin_id',$id)->update($post);
       // dd($res);
       if($res!==false){
        return redirect('/admin/index');
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
        $res=Admin::destroy($id);

        if($res){
            return redirect('/admin/index');
        }
    }
}
