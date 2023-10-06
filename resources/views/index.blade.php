
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>
<!-- ...........................form............................... -->
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 border shadow-lg mt-5">
			<h3 class="text-center my-5">Registration Form(Laravel with MVC)</h3>
			@if(isset($post))
			<form method="POST" action="{{$post->id}}">
				@csrf
				<p><input name="title" type="Text" value="{{$post->title}}" placeholder="Enter Title"  class="name form-control" required=""></p>
				<p><input name="author" value="{{$post->author}}" type="Text" placeholder="Enter Author" class="email form-control" required></p>
				<button onClick="insertData()" class="button bg-info my-3 rounded shadow ibtn">Update</button>
				 <button  class="button bg-info my-3 rounded shadow">Cancle</button>
			</form>
			@else
				<form method="POST" action="/store">
				@csrf
				<p><input name="title" type="Text" placeholder="Enter Title" class="name form-control" required=""></p>
				<p><input name="author" type="Text" placeholder="Enter Author" class="email form-control" required></p>
				<button name="btnSubmit" onClick="insertData()" class="button bg-info my-3 rounded shadow ibtn">Submit</button>
				 <button name="btnCancle" class="button bg-info my-3 rounded shadow">Cancle</button>
			</form>
			@endif
			
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
<!-- .......................................table.................................... -->
<div class="container-fluid mt-5">
	<div class="row">
		<table class="table table-striped table-bordered">
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Author</th>
				<th>Create Date</th>
				<th>Modify Date</th>
				<th>Process</th>
			</tr>
			@foreach($posts as $post)
			<tbody class="body">	
				<tr>
					<td>{{$post->id}}</td>
					<td>{{$post->title}}</td>
					<td>{{$post->author}}</td>
					<td>{{$post->created_at}}</td>
					<td>{{$post->updated_at}}</td>
					<td><a href="{{url('edit/'.$post->id)}}" class="btn btn-info">Edit</a><a href="delete/{{$post->id}}" class="btn btn-info ms-5">Delete</a></td>
				</tr>
			</tbody>
			@endforeach
		</table>
	</div>
</div>
</body>
</html>