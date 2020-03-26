<form action="{{url('student/store')}}" method="post">
	@csrf
	<tr>
		<td>学生姓名</td>
		<td>
			<input type="text" name="name">
		</td>
	</tr>
	<tr>
		<td>学生性别</td>
		<td>
			<input type="radio" name="sex" value="男">男
			<input type="radio" name="sex" value="女">女
		</td>
	</tr>
	<tr>
		<td>学生班级</td>
		<td>
			<input type="text" name="class">
		</td>
	</tr>
	<tr>
		<td><input type="submit" value="添加"></td>
		<td></td>
	</tr>
</form>
