<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<form action="{{url('/cate/update/'.$cate->cate_id)}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="cate_name" 
				   placeholder="分类名" value="{{$cate->cate_name}}" >
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="cate_fu" 
				   placeholder="分类" value="{{$cate->cate_fu}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="cate_desc" 
				   placeholder="分类描述">{{$cate->cate_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否在导航显示</label>
		<div class="col-sm-8">
			<input type="radio" name="cate_nav" value="1" {{$cate->cate_nav==1?"checked":""}}>是
			<input type="radio" name="cate_nav" value="2" {{$cate->cate_nav==2?"checked":""}}>否
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