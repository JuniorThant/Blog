<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <div class="container">
                        <div class="row d-flex justify-content-end my-5">
                        <form action="/admin/users/index">
                            @csrf
        <div class="input-group">
          <input
          name="search"
          value="{{request('search')}}"
            type="text"
            autocomplete="false"
            class="form-control"
            placeholder="Search Users..."
          />
          <button
            class="input-group-text bg-primary text-light"
            id="searchuserButton"
            type="submit"
          >
            Search
          </button>
        </div>
      </form>
                        <table class="table table-striped table-bordered my-3">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Create Date</th>
                                <th>Modify Date</th>
                                <th>Status</th>
                                <th>Process</th>
                            </tr>
                            @foreach($users as $user)
                            <tbody class="body">	
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at->toDateString()}}</td>
                                    <td>{{$user->updated_at->toDateString()}}</td>
                                    <td> @if($user->is_admin=='Admin')
                                                <b class="text-success">Admin</b>
                                            @else
                                            <b class="text-danger">User</b>
                                            @endif</td>
                                    <td>         @auth
                                            @if($user->is_admin=='Admin')
                                                <form method="post" action="/admin/users/index/removeadmin/{{ $user->id }}" class="my-2">
                                                    @csrf
                                                <button type="submit" class="btn btn-danger" >
                                                    Remove Admin
                                                </button>
                                                </form>
                                            @else
                                            <form method="post" action="/admin/users/index/giveadmin/{{ $user->id }}" class="my-2">
                                            @csrf
                                                <button type="submit" class="btn btn-success">
                                                    Give Admin
                                                </button>
                                            </form>
                                            @endif
                                        @endauth
                                    <a href="{{url('admin/users/index/'.$user->id)}}" class="btn btn-primary mx-2">Delete Account</a></td>
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