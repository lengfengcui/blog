<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>新闻列表</title>
	<link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">  
	<script src="/static/admin/js/jquery.min.js"></script>
	<script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>新闻列表<a style="float:right;" href="{{url('news/create')}}" class="btn btn-default">添加</a></h2></center><hr/>  
<form>
	<input type="text" name="new_title" placeholder="请输入新闻标题" value="{{$query['new_title']??''}}">
	<input type="text" name="new_author" placeholder="请输入新闻作者" value="{{$query['new_author']??''}}"> 
	<button>搜索</button>
</form>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>新闻ID</th>
				<th>新闻分类</th>
				<th>新闻作者</th>
				<th>发布时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($news as $v) 
			<tr>
				<td>{{$v->new_id}}</td>
				<td>{{$v->new_title}}</td>
				<td>{{$v->new_author}}</td>
				<td>{{date("Y-m-d H:i:s",$v->new_time)}}</td>
				<td>
					<a href="" class="btn btn-primary">编辑</a>|
					<a href="" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			<tr><td colspan="6">{{$news->appends($query)->links()}}</td></tr>
		</tbody>
</table>
</div>  	
<script>
	$(document).on('click','.pagination a',function(){
	//$('.pagination a').click(function(){
		var url=$(this).attr('href');
		$.get(url,function(result){
			$('tbody').html(result);
		});
		return false;
	});
</script>
</body>
</html>