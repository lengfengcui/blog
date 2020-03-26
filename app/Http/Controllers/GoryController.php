<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gory;
use App\Brand;
use App\Category;
use DB;
use Illuminate\Validation\Rule;
class GoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $g_name=request()->g_name;
        $where=[];
        if($g_name){
            $where[]=['g_name','like',"%$g_name%"];
        }
        //DB::connection()->enableQueryLog();
         $gory=Gory::select('gory.*','brand.brand_name','category.cate_name')
                    ->leftjoin('category','gory.cate_id','=','category.cate_id')
                    ->leftjoin('brand','gory.brand_id','=','brand.brand_id')
                    ->where($where)
                    ->get();
        // $logs = DB::getQueryLog();
        // dd($logs);
        
        //dd($gory);
         return view('gory.index',['gory'=>$gory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //品牌
        $brand_res=Brand::all();
        //分类
        $cate=Category::all();
        //dd($cate);
        //无限极分类
        $cate=CreateTree($cate);
        //dd($cate);
        return view('gory.create',['brand_res'=>$brand_res,'cate'=>$cate]);
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
            'g_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u|unique:gory',
            'cate_id'=>'required',
            'brand_id'=>'required',
            'g_price'=>'required|numeric',
            'g_num'=>'required|numeric|between:1,9999999',
            
        ],[
            'g_name.regex'=>'商品名称可以包含中文、数字、字母、下划线、长度范围为2-50位',
            'g_name.unique'=>'商品名称已存在',
            'cate_id.required'=>'请选择商品分类',
            'brand_id.required'=>'请选择商品品牌',
            'g_price.required'=>'商品价格必填',
            'g_price.numeric'=>'商品价格必须是数字',
            'g_num.required'=>'商品库存必填',
            'g_num.numeric'=>'商品库存必须是数字',
            'g_num.between'=>'商品库存不超过8位',

        ]);
       

        //文件上传
       if ($request->hasFile('g_logo')) { 
            $post['g_logo']=$this->upload('g_logo');
        }


        //多文件上传
        if ($request->hasFile('g_imgs')) { 
            $g_imgs=$this->Moreupload('g_imgs');
            $post['g_imgs']=implode('|',$g_imgs);
        }
       
        $res=Gory::insert($post);
       if($res){
        return redirect('/gory/index');
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
                $store_result[$k]=$v->store('uploads');
            }else{
                 $store_result[$k]='未获取到上传文件或上传过程出错';
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

        $gory=Gory::where('g_id',$id)->first();
        //品牌
        $brand_res=Brand::all();
        //分类
        $cate=Category::all();
        //dd($cate);
        //无限极分类
        $cate=CreateTree($cate);
        return view('gory.edit',['gory'=>$gory,'brand_res'=>$brand_res,'cate'=>$cate]);
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
        $validatedData = $request->validate([ 
            'g_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
            Rule::unique('gory')->ignore($id,'g_id'),
            'cate_id'=>'required',
            'brand_id'=>'required',
            'g_price'=>'required|numeric',
            'g_num'=>'required|numeric|between:1,9999999',
            
        ],[
            'g_name.regex'=>'商品名称可以包含中文、数字、字母、下划线、长度范围为2-50位',
            'g_name.unique'=>'商品名称已存在',
            'cate_id.required'=>'请选择商品分类',
            'brand_id.required'=>'请选择商品品牌',
            'g_price.required'=>'商品价格必填',
            'g_price.numeric'=>'商品价格必须是数字',
            'g_num.required'=>'商品库存必填',
            'g_num.numeric'=>'商品库存必须是数字',
            'g_num.between'=>'商品库存不超过8位',

        ]);
         //排除接收谁
       $post=$request->except(['_token']);
       //dd($post);
       //文件上传
       if ($request->hasFile('g_logo')) { 
            $post['g_logo']=$this->upload('g_logo');
        }


        //多文件上传
        if ($request->hasFile('g_imgs')) { 
            $g_imgs=$this->Moreupload('g_imgs');
            $post['g_imgs']=implode('|',$g_imgs);
        }
       

        $res=Gory::where('g_id',$id)->update($post);
        //dd($res);
        if($res!==false){
        return redirect('/gory/index');
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
        $res=Gory::destroy($id);

        if($res){
            return redirect('/gory/index');
        }
    }
}
