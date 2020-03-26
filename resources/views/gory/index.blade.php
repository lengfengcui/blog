<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>品牌列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 <center><h2>商品品牌列表<a style="float:right;" href="{{url('gory/create')}}" class="btn btn-default">添加</a></h2></center><hr/> 
<form>
	<input type="text" name="g_name" placeholder="请输入品牌关键字">
	 
	<button>搜索</button>
</form>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>商品ID</th>
				<th>商品名称</th>
				<th>商品货号</th>
				<th>商品分类</th>
				<th>分类</th>
				<th>商品品牌</th>
				<th>价格</th>
				<th>库存</th>
				<th>是否显示</th>
				<th>是否新品</th>
				<th>是否精品</th>
				<th>商品主图</th>
				<th>商品相册</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($gory as $v) 
			<tr>
				<td>{{$v->g_id}}</td>
				<td>{{$v->g_name}}</td>
				<td>{{$v->g_number}}</td>
				<td>{{$v->cate_name}}</td>
				<td>{{$v->brand_name}}</td>
				<td>{{$v->g_pai}}</td>
				<td>{{$v->g_price}}</td>
				<td>{{$v->g_num}}</td>
				<td>{{$v->g_show}}</td>
				<td>{{$v->g_new}}</td>
				<td>{{$v->g_fine}}</td>
				<td>@if($v->g_logo)<img src="{{env('UPLOADS_URL')}}{{$v->g_logo}}" height="35" width="35">@endif</td>
				<td>
					@if($v->g_imgs)
					@php $g_imgs=explode('|',$v->g_imgs);  @endphp
					@foreach ($g_imgs as $vv) 
					<img src="{{env('UPLOADS_URL')}}{{$vv}}" height="35" width="35">
					@endforeach
					@endif
				</td>
				<td>
					<a href="{{url('/gory/edit/'.$v->g_id)}}" class="btn btn-primary">编辑</a>|
					<a href="{{url('/gory/destroy/'.$v->g_id)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			
		</tbody>
</table>
</div>  	

</body>
</html>