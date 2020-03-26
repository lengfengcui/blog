<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>文章添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form action="{{url('/article/update/'.$article->t_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="t_title" 
				   placeholder="文章标题" value="{{$article->t_title}}">
		</div>
		<b style="color:red">{{$errors->first('t_title')}}</b>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-8">
			<select name="cate_id">
				<option value="0">-请选择-</option>
				@foreach ($cate as $k=>$v)
				<option value="{{$v->cate_id}}">{{str_repeat('|--',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
			<b style="color:red">{{$errors->first('cate_id')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-8">
			<input type="radio" name="t_yao" value="1" {{$article->t_yao==1?'checked':''}}>普通
			<input type="radio" name="t_yao" value="2" {{$article->t_yao==2?'checked':''}}>置顶
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-8">
			<input type="radio" name="t_show" value="1" {{$article->t_show==1?'checked':''}}>显示
			<input type="radio" name="t_show" value="2" {{$article->t_show==2?'checked':''}}>不显示
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="t_name" 
				   placeholder="文章作者" value="{{$article->t_name}}">
				  <b style="color:red">{{$errors->first('t_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="t_email" 
				   placeholder="作者email" value="{{$article->t_email}}">
				  <b style="color:red">{{$errors->first('t_email')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="t_zi" 
				   placeholder="关键字" value="{{$article->t_zi}}">
				  <b style="color:red">{{$errors->first('t_zi')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-8">
			<textarea type="text" class="form-control" id="firstname" name="t_desc" 
				   placeholder="网页描述">{{$article->t_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		@if($article->t_logo)<img src="{{env('UPLOADS_URL')}}{{$article->t_logo}}" height="35" width="35">@endif
		<div class="col-sm-4">
			<input type="file" class="form-control" id="firstname" name="t_logo">
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