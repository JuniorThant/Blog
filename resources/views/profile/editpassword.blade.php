<x-layout>
    <x-slot name="content">
        <section id="account">
            <div class="container">
                <h2 class="text-center my-5">Account Settings</h2>
                <div class="card m-5" style="padding: 0;">
                
                    <div class="row">
                        
                        <x-profilesettings />

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
                                <div class="alert alert-success showSuccess" role="alert" style="display:none;">
                                    Password Updated Successfully!
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

      
<script src="{{ asset('js/source.js') }}" defer></script>
    </x-slot>
</x-layout>