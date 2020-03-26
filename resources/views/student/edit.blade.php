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
<form action="{{url('student/update/'.$student->id)}}" method="post">
	@csrf
	<tr>
		<td>学生姓名</td>
		<td>
			<input type="text" name="name" value="{{$student->name}}">
		</td>
	</tr>
	<br>
	<tr>
		<td>学生性别</td>
		<td>
			<input type="radio" name="sex" value="男" checked>男
			<input type="radio" name="sex" value="女">女
		</td>
	</tr>
	<br>
	<tr>
		<td>学生班级</td>
		<td>
			<input type="text" name="class" value="{{$student->class}}">
		</td>
	</tr>
	<br>
	<tr>
		<td><input type="submit" value="添加"></td>
		<td></td>
	</tr>
</form>

</body>
</html>
