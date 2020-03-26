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

<tr><td colspan="6">{{$news->links()}}</td></tr>