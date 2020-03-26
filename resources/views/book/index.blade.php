<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>图书管理列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 <center><h2>图书管理列表<a style="float:right;" href="{{url('book/create')}}" class="btn btn-default">添加</a></h2></center><hr/> 
 <form>
	<input type="text" name="shu" placeholder="请输入书名关键字" value="{{$query['shu']??''}}">
	<input type="text" name="name" placeholder="请输入作者关键字" value="{{$query['name']??''}}"> 
	<button>搜索</button>
</form>
 <div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>图书管理ID</th>
				<th>书名</th>
				<th>作者</th>
				<th>售价</th>
				<th>图书封面</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($book as $v) 
			<tr>
				<td>{{$v->book_id}}</td>
				<td>{{$v->book_shu}}</td>
				<td>{{$v->book_name}}</td>
				<td>{{$v->book_price}}</td>
				<td>@if($v->book_logo)<img src="{{env('UPLOADS_URL')}}{{$v->book_logo}}" height="35" width="35">@endif</td>
				<td>
					<a href="" class="btn btn-primary">编辑</a>|
					<a href="" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach
			<tr><td colspan="6">{{$book->appends($query)->links()}}</td></tr>
		</tbody>
</table>
</div>  	

</body>
</html>