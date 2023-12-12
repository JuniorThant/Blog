<div class="col-md-4">
    <div class="list-group border border-0">
        <a style="font-size:19px;" class="list-group-item border border-0 {{ request()->is('blogposts/profile/editprofile') ? 'hoveractive' : '' }}" id="linkProfile" href="#"><i class="bi bi-person-circle"></i> Edit Profile</a>
        <a style="font-size:19px;" class="list-group-item border border-0 {{ request()->is('blogposts/profile/editpassword') ? 'hoveractive' : '' }}" id="linkPassword" href="#"><i class="bi bi-lock-fill"></i> Password</a>
        <a style="font-size:19px;" class="list-group-item border border-0" id="linkUserManual" href="{{ asset('usermanual.pdf') }}" target="_blank"><i class="bi bi-book"></i> User Manual</a>
        <a style="font-size:19px;" class="list-group-item border border-0" href="/blogposts/profile"><i class="bi bi-arrow-left-circle-fill"></i> Back</a>
        <a style="font-size:19px;" class="list-group-item border border-0" href="#staticBackdrop" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>
    <div class="profileline"></div>
</div>

