<table class="table">
		<thead>
			<tr>
				<th>学生ID</th>
				<th>学生名字</th>
				<th>学生年龄</th>
				<th>班级</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($student as $v) 
			<tr>
				<td>{{$v->id}}</td>
				<td>{{$v->name}}</td>
				<td>{{$v->sex}}</td>
				<td>{{$v->class}}</td>
				<td>
					<a href="{{url('/student/edit/'.$v->id)}}" class="btn btn-primary">编辑</a>|
					<a href="{{url('/student/destroy/'.$v->id)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach
		</tbody>
</table>