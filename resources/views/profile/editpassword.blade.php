<x-layout>
    <x-slot name="content">
        <section id="account">
            <div class="container">
                <h2 class="text-center my-5">Account Settings</h2>
                <div class="card m-5" style="padding: 0;">
                
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-group">
                            <a style="font-size:19px;" class="list-group-item border border-0" id="linkProfile" href="#"><i class="bi bi-person-circle"></i> Edit Profile</a>
                                <a style="font-size:19px;" class="list-group-item border border-0  hoveractive" id="linkPassword" href="#"><i class="bi bi-lock-fill"></i> Password</a>
                                <a style="font-size:19px;" class="list-group-item border border-0" id="linkPassword" href="{{asset('usermanual.pdf')}}" target="_blank"><i class="bi bi-book"></i> User Manual</a>
                                <a style="font-size:19px;" class="list-group-item border border-0" href="/blogposts/profile"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
                                <a style="font-size:19px;" class="list-group-item border border-0" href="#staticBackdrop" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-box-arrow-left"></i> Logout</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                        <div class="verticalline d-md-block"></div>
                            <!-- Form 2 -->
                            <form id="passwordForm" class="p-3" method="POST">
                               <div class="row">
                                <div class="col-md-12" style="width:100%;height:459px;">
                                @csrf
                                <div class="mb-3">
                                    <label for="oldPassword" class="form-label">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" id="oldPassword">
                                    <x-error name="old_password"/>
                                </div>
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="newPassword">
                                    <x-error name="new_password"/>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-control" id="confirmNewPassword">
                                </div>
                                <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                               </div>
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