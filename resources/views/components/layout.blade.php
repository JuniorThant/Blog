<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog Factory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/image.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Rubik+Marker+Hatch&family=Spectral&display=swap" rel="stylesheet">
</head>
<body id="home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-unwhite" id="navigationTop">
        <div class="container-fluid">
            <img src="/images/youthblogs.png" alt="" class="img-fluid bg-black" style="height: 80px;">
            <button class="navbar-toggler border border-1 border-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <img src="/images/navbaricon.png" alt="">
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-5">
                    <a class="nav-link fs-5 mx-1" aria-current="page" href="/blogposts">Home</a>
                    @guest
                    <a class="nav-link fs-5 mx-1" aria-current="page" href="/blogposts/register">Register</a>
                    <a class="nav-link fs-5 mx-1" aria-current="page" href="/blogposts/login">Login</a>
                    @else
                    @if(auth()->user()->is_admin=='Admin')
                    <a class="nav-link fs-5 mx-1" aria-current="page" href="/admin/category/create">Admin Control</a>
                    @endif
                    <div class="dropdown dropdown-menu-dark bg-unwhite">
                        <button class="bg-unwhite dropdown-toggle border border-0 nav-link fs-5 mx-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                            <img src="/storage/{{auth()->user()->avatar}}" width="30" height="30" class="rounded-circle" alt="">
                            {{auth()->user()->name}}
                        </button>
                        <ul class="dropdown-menu bg-dark">
                            <li><a class="dropdown-item text-white" href="/blogposts/profile"><i class="bi bi-person-circle text-white"></i> My Profile</a></li>
                            <li><a class="dropdown-item text-white" href="/blogposts/profile/editprofile"><i class="bi bi-gear-fill text-white"></i> Account Settings</a></li>
                            <li><a class="dropdown-item text-white" href="#staticBackdrop" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-box-arrow-left text-white"></i> Logout</a></li>
                        </ul>
                    </div>
                    <a class="nav-link fs-5 mx-1" aria-current="page" href="/blogposts/create">Create Blogs</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    {{$content}}

    <x-logout />

    <!-- Footer -->
    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <script src="{{ asset('js/source.js') }}" defer></script>
</body>
</html>
