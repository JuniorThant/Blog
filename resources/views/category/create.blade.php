<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .full {
            background-color: black; /* You can replace this with your desired background color */
            color: #fff; /* Text color on the dark background */
            height: 100%; /* 100% of the viewport height */
            position:fixed;
            z-index:1;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 full py-3">
                <!-- Content for the first div -->
                <h4 class="mb-5">Admin Dashboard</h4>
                <div class="list-group border border-0" style="margin:0;">
                <li class="list-group-item py-3" style="background-color:black;"> <a style="font-size:19px;" class="border border-0 hoveractive"  href="/admin/category/create">Category</a></li>
                <li class="list-group-item py-3" style="background-color:black;"><a style="font-size:19px;" class="border border-0 hoveractive"  href="/admin/users/index">Users</a></li>
                <li class="list-group-item py-3" style="background-color:black;"><a style="font-size:19px;" class="border border-0 hoveractive"  href="/blogposts">Back</a></li>
                            </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-6 my-5">
                        @if(isset($category))
                            <form method="post" class="border border-2 p-3 rounded" action="{{$category->id}}">
                            @csrf
                            <h3 class="text-center">Category Update Form</h3>
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" value="{{ old('name',$category->name) }}" class="form-control name">
                                <x-error name="name"/>
                            </div> 
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                        @else
                            <form method="post" class="border border-2 p-3 rounded">
                            @csrf
                            @method('PATCH')
                            <h3 class="text-center">Category Create Form</h3>
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control name">
                                <x-error name="name"/>
                            </div> 
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
               
                            </div>
                            </form>
                        @endif
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-end">
                        <form action="/admin/category/create" method="post" class="my-1">
                            @csrf
        <div class="input-group mb-3">
          <input
          name="searchcategory"
          value="{{request('searchcategory')}}"
            type="text"
            autocomplete="false"
            class="form-control"
            placeholder="Search Categories..."
          />
          <button
            class="input-group-text bg-primary text-light"
            id="searchcategoryButton"
            type="submit"
          >
            Search
          </button>
        </div>
      </form>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Create Date</th>
                                <th>Modify Date</th>
                                <th>Process</th>
                            </tr>
                            @foreach($categories as $category)
                            <tbody class="body">	
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->updated_at}}</td>
                                    <td><a href="{{url('admin/category/edit/'.$category->id)}}" class="btn btn-info mx-2">Edit</a><a href="{{url('admin/category/create/'.$category->id)}}" class="btn btn-info mx-2">Delete</a></td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/all.js') }}" defer></script>
</body>
</html>
