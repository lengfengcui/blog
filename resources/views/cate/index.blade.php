<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>分类列表展示</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品品牌列表<a style="float:right;" href="{{url('cate/create')}}" class="btn btn-default">添加</a></h2></center><hr/> 
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>分类ID</th>
				<th>分类名称</th>
				<th>分类</th>
				<th>分类描述</th>
				<th>是否在导航显示</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cate as $v) 
			<tr>
				<td>{{$v->cate_id}}</td>
				<td>{{$v->cate_name}}</td>
				<td>{{$v->cate_fu}}</td>
				<td>{{$v->cate_desc}}</td>
				<td>{{$v->cate_nav}}</td>
				<td>
					<a href="{{url('/cate/edit/'.$v->cate_id)}}" class="btn btn-primary">编辑</a>|
					<a href="{{url('/cate/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			<tr><td colspan="6">{{$cate->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>