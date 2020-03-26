<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests\StoreBrandPost;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //dd(encrypt(123456));
        $name=request()->name;
        $where=[];
        if($name){
            $where[]=['brand_name','like',"%$name%"];
        }
        $url=request()->url;
        if($url){
            $where[]=['brand_url','like',"%$url%"];
        }
        //$brand = DB::table('brand')->get();
        
        //ORM
        // $brand=brand::all();
        $pageSize=config('app.pageSize');
        $brand=Brand::where($where)->orderby('brand_id','desc')->paginate($pageSize);
        //dd($brand);
        $query=request()->all();
        return view('brand.index',['brand'=>$brand,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //第二种验证
    //public function store(StoreBrandPost $request)
    {   

        /*第一种验证
        $validatedData = $request->validate([ 
            'brand_name' => 'required|unique:brand|max:20', 
            'brand_url' => 'required', 
        ],[
            'brand_name.required'=>'品牌名称必填！',
            'brand_name.unique'=>'品牌名称已存在！',
            'brand_name.max'=>'品牌名称最大长度不超过20位！',
            'brand_url.required'=>'品牌网址必填！',
        ]);*/



       $post=$request->except('_token');
       //dump($post);
       

       //第三种验证
       $validator = Validator::make($post, [ 
        'brand_name' => 'required|unique:brand|max:20', 
        'brand_url' => 'required', 
        ],[
            'brand_name.required'=>'品牌名称必填！',
            'brand_name.unique'=>'品牌名称已存在！',
            'brand_name.max'=>'品牌名称最大长度不超过20位！',
            'brand_url.required'=>'品牌网址必填！',
        ]);
        if($validator->fails()) { 
            return redirect('brand/create') 
                ->withErrors($validator) 
                ->withInput(); 
        }

       //文件上传
       if ($request->hasFile('brand_logo')) { 
            $post['brand_logo']=upload('brand_logo');
        }


        //多文件上传
        if ($request->hasFile('brand_imgs')) { 
            $brand_imgs=Moreupload('brand_imgs');
            $post['brand_imgs']=implode('|',$brand_imgs);
        }
        
        //dd($post);
       //$res=DB::table('brand')->insert($post);
       //dd($res);
       

       //ORM添加第一种
        // $brand=new Brand;
        // $brand->brand_name=$request->brand_name;
        // $brand->brand_url=$request->brand_url;
        // $brand->brand_logo=$request->brand_logo;
        // $brand->brand_desc=$request->brand_desc;
        // $res=$brand->save();
        //dd($res);
        
       //ORM添加第二种
       //$res=brand::create($post);

       //ORM添加第三种
       $res=brand::insert($post);

       if($res){
        return redirect('/brand/index');
       }
    
    }
    /**
     * Display the specified resource.
     *详情页展示 (预览)
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *展示编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //根据id获取单条记录
       //$brand=DB::table('brand')->where('brand_id',$id)->first();
       

       //ORM第一种
       //$brand=Brand::find($id);
       //ORM第二种
       $brand=Brand::where('brand_id',$id)->first();

        return view('brand.edit',['brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //排除接收谁
       $post=$request->except(['_token']);
       //dd($post);
       if ($request->hasFile('brand_logo')) { 
            $post['brand_logo']=$this->upload('brand_logo');
        }
       // $res=DB::table('brand')->where('brand_id',$id)->update($post);
       
        
        //ORM添加第一种
        // $brand=new Brand;
        // $brand->brand_name=$request->brand_name;
        // $brand->brand_url=$request->brand_url;
        // $brand->brand_logo=$request->brand_logo;
        // $brand->brand_desc=$request->brand_desc;
        // $res=$brand->save();
        // $brand=Brand::find($id);
        

        //ORM添加第二种
        $res=Brand::where('brand_id',$id)->update($post);

        if($res!==false){
        return redirect('/brand/index');
       }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$res=DB::table('brand')->where('brand_id',$id)->delete();
        //dd($res);
        

        //ORM
        $res=Brand::destroy($id);

        if($res){
            return redirect('/brand/index');
        }
    }
    public function checkOnly(){
        $brand_name=request()->brand_name;
        $count=Brand::where('brand_name',$brand_name)->count();
        
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
