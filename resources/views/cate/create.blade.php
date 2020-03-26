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
	<center><h2>商品品牌列表<a style="float:right;" href="{{url('cate/index')}}" class="btn btn-default">展示</a></h2></center><hr/> 
	<form action="{{url('/cate/store')}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="cate_name" 
				   placeholder="分类名">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="cate_fu" 
				   placeholder="分类">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="cate_desc" 
				   placeholder="分类描述"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否在导航显示</label>
		<div class="col-sm-8">
			<input type="radio" name="cate_nav" value="1">是
			<input type="radio" name="cate_nav" value="2">否
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>