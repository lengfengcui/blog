<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>售楼列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 <center><h2>售楼列表<a style="float:right;" href="{{url('leng/create')}}" class="btn btn-default">添加</a></h2></center><hr/> 
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>售楼ID</th>
				<th>小区名称</th>
				<th>导购人</th>
				<th>导购联系方式</th>
				<th>房屋面积</th>
				<th>房屋图片</th>
				<th>房屋相册</th>
				<th>售价</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($leng as $v) 
			<tr>
				<td>{{$v->cid}}</td>
				<td>{{$v->cname}}</td>
				<td>{{$v->cman}}</td>
				<td>{{$v->ctel}}</td>
				<td>{{$v->clen}}</td>
				<td>@if($v->clogo)<img src="{{env('UPLOADS_URL')}}{{$v->clogo}}" height="35" width="35">@endif</td>
				<td>
					@if($v->cimgs)
					@php $cimgs=explode('|',$v->cimgs);  @endphp
					@foreach ($cimgs as $vv) 
					<img src="{{env('UPLOADS_URL')}}{{$vv}}" height="35" width="35">
					@endforeach
					@endif
				</td>
				<td>{{$v->cprice}}</td>
				<td>
					<a href="" class="btn btn-primary">编辑</a>|
					<a href="" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

		</tbody>
</table>
</div>  	

</body>
</html>