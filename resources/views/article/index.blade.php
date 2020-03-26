<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
 <center><h2>文章列表<a style="float:right;" href="{{url('article/create')}}" class="btn btn-default">添加</a></h2></center><hr/>
<form>
	文章标题<input type="text" name="t_title" placeholder="请输文章标题关键字">
	<button>搜索</button>
</form>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>编号</th>
				<th>文章标题</th>
				<th>文章分类</th>
				<th>文章重要性</th>
				<th>是否显示</th>
				<th>文章作者</th>
				<th>作者email</th>
				<th>关键字</th>
				<th>网页描述</th>
				<th>上传文件</th>
				<th>添加日期</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($article as $v) 
			<tr t_id="{{$v->t_id}}">
				<td>{{$v->t_id}}</td>
				<td>{{$v->t_title}}</td>
				<td>{{$v->cate_name}}</td>
				<td>{{$v->t_yao==1?"√":"×"}}</td>
				<td>{{$v->t_show==1?"√":"×"}}</td>
				<td>{{$v->t_name}}</td>
				<td>{{$v->t_email}}</td>
				<td>{{$v->t_zi}}</td>
				<td>{{$v->t_desc}}</td>
				<td>@if($v->t_logo)<img src="{{env('UPLOADS_URL')}}{{$v->t_logo}}" height="35" width="35">@endif</td>
				<td>{{date("Y-m-d H:i:s",$v->t_time)}}</td>
				<td>
					<a href="{{url('/article/edit/'.$v->t_id)}}" class="btn btn-primary">编辑</a>|
					<a href="javascript:void(0)" id="{{$v->t_id}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			<tr><td colspan="6">{{$article->appends($query)->links()}}</td></tr>
		</tbody>
</table>
</div>  	
 <script>
	$('.btn-danger').click(function(){
		var id=$(this).attr('id');
		if(confirm('确认删除当前记录吗？')){
			// $.get('/article/destroy/'+id,function(result){
			// 	if(result.code=='00000'){
			// 		location.reload();
			// 	}
			// },'json');
			$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
			$.post('/article/destroy/'+id,function(result){
				if(result.code=='00000'){
					location.reload();
				}
			},'json');
		}
	});
	
</script>
</body>
</html>