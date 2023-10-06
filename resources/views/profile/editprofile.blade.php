<x-layout>
    <x-slot name="content">
        <section id="account">
            <div class="container">
                <h2 class="text-center my-5">Account Settings</h2>
                <div class="card m-5" style="position:relative;">
                
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-group border border-0">
                            <a style="font-size:19px;" class="list-group-item border border-0 hoveractive" id="linkProfile" href="#"><i class="bi bi-person-circle"></i> Edit Profile</a>
                                <a style="font-size:19px;" class="list-group-item border border-0" id="linkPassword" href="#"><i class="bi bi-lock-fill"></i> Password</a>
                                <a style="font-size:19px;" class="list-group-item border border-0" id="linkPassword" href="{{asset('usermanual.pdf')}}" target="_blank"><i class="bi bi-book"></i> User Manual</a>
                                <a style="font-size:19px;" class="list-group-item border border-0" href="/blogposts/profile"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
                                <a style="font-size:19px;" class="list-group-item border border-0" href="#staticBackdrop" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-box-arrow-left"></i> Logout</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                        <div class="verticalline d-md-block"></div>
                            <!-- Form 1 -->
                            <form id="updateprofileForm" class="p-3" method="POST" enctype="multipart/form-data">
                                @csrf
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center" style="width: 110px; height: 110px;">
                                                <!-- Display the existing image and add a click event to trigger the file input -->
                                                <img style="height: 100%; width:100%;" src="{{ old('avatar', asset('storage/' . auth()->user()->avatar)) }}" alt="Blog Image" class="img-thumbnail" id="avatarImage" style="cursor: pointer;">

                                                <!-- Hidden input field for updating the image -->
                                                <input type="file" name="avatar" id="avatarInput" style="display: none;">
                                            </div>
                                            <p class="fs-5 mt-2"> Change Profile</p>
                                        </div>
                                <div class="mb-3">
                                    <label for="exampleInputName1" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control name" id="exampleInputName1" aria-describedby="nameHelp">
                                    <x-error name="name"/>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputUsername1" class="form-label">Username</label>
                                    <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" class="form-control username" id="exampleInputusername1" aria-describedby="usernameHelp">
                                    <x-error name="username"/>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <x-error name="email"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Add Your Job (Optional)</label>
                                    <input type="job" name="job" value="{{ old('job', auth()->user()->job) }}" class="form-control job" aria-describedby="jobHelp" placeholder="Programmer">
                                    <x-error name="job"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Add Your Bio (Optional)</label>
                                    <input type="bio" name="bio" value="{{ old('bio', auth()->user()->bio) }}" class="form-control bio" aria-describedby="bioHelp" placeholder="....">
                                    <x-error name="bio"/>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <x-logout></x-logout>

      
<script src="{{ asset('js/profile.js') }}" defer></script>
    </x-slot>
</x-layout>
