<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form action="{{url('/gory/update/'.$gory->g_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="g_name" value="{{$gory->g_name}}" 
				   placeholder="品牌名称">
			<b style="color:red">{{$errors->first('g_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="g_number" value="{{$gory->g_number}}" 
				   placeholder="商品货号">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-8">
			<select name="cate_id">
				<option value="0">--请选择--</option>
				@foreach ($cate as $k=>$v)
				<option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
			<b style="color:red">{{$errors->first('cate_id')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-8">
			<select name="brand_id">
				<option value="0">--请选择--</option>
				@foreach ($brand_res as $k=>$v)
				<option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
				@endforeach
			</select>
			<b style="color:red">{{$errors->first('brand_id')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="g_price" value="{{$gory->g_price}}" 
				   placeholder="商品价格">
			<b style="color:red">{{$errors->first('g_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="g_num" value="{{$gory->g_num}}" 
				   placeholder="商品库存">
			<b style="color:red">{{$errors->first('g_num')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
			<input type="radio" name="g_show" value="1" {{$gory->g_show==1?'checked':''}}>是
			<input type="radio" name="g_show" value="2" {{$gory->g_show==2?'checked':''}}>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-8">
			<input type="radio" name="g_new" value="1" {{$gory->g_new==1?'checked':''}}>是
			<input type="radio" name="g_new" value="2" {{$gory->g_new==2?'checked':''}}>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-8">
			<input type="radio" name="g_fine" value="1" {{$gory->g_fine==1?'checked':''}}>是
			<input type="radio" name="g_fine" value="2" {{$gory->g_fine==2?'checked':''}}>否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌主图</label>
		@if($gory->g_logo)<img src="{{env('UPLOADS_URL')}}{{$gory->g_logo}}" height="35" width="35">@endif
		<div class="col-sm-4">
			<input type="file" class="form-control" id="firstname" name="g_logo" 
				   placeholder="品牌LOGO">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌相册</label>
		@if($gory->g_imgs)
		@php $g_imgs=explode('|',$gory->g_imgs);  @endphp
		@foreach ($g_imgs as $vv) 
		<img src="{{env('UPLOADS_URL')}}{{$vv}}" height="35" width="35">
		@endforeach
		@endif
		<div class="col-sm-4">
			<input type="file" class="form-control" id="firstname" name="g_imgs[]" multiple="multiple" 
				   placeholder="品牌相册">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>

</body>
</html>