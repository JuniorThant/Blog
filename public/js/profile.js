$(document).ready(function () {
    $('#linkPassword').click(function(e){
        $.ajax({
            type: 'GET',
            url: '/blogposts/profile/editpassword', // Use your existing blog posts route
            success: function (data) {
                // Update the content of the container with the new posts
                $('body').html(data);
    
                // Update the browser's address bar with the new URL
                var newUrl = '/blogposts/profile/editpassword';
                history.pushState(null, null, newUrl);
            }
        });
        e.preventDefault();
    });

    $('#linkProfile').click(function(e){
        $.ajax({
            type: 'GET',
            url: '/blogposts/profile/editprofile', // Use your existing blog posts route
            success: function (data) {
                // Update the content of the container with the new posts
                $('body').html(data);
    
                // Update the browser's address bar with the new URL
                var newUrl = '/blogposts/profile/editprofile';
                history.pushState(null, null, newUrl);
            }
        });
        e.preventDefault();
    });


    $('#updateprofileForm').validate({
        submitHandler: function(uform) {
            var name = $('.name').val();
            var username = $('.username').val();
            var email = $('.email').val();
            var job = $('.job').val();
            var bio = $('.bio').val();
            var formData = new FormData(uform);

            // Log individual form field values to the console
            console.log('name:', name);
            console.log('username:', username);
            console.log('email:', email);
            console.log('job:', job);
            console.log('bio:', bio);
            console.log('avatar:', formData.get('avatar')); // Log the selected thumbnail file

            $.ajax({
                url: "/blogposts/profile/editprofile",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('body').html(data);
                },
                error: function (data) {
                    showProfileError();
                }
            });
        }
    });

    function showProfileError() {

        var name = $('.name').val();
        var username = $('.username').val();
        var email = $('.email').val();
        var job = $('.job').val();
        var bio = $('.bio').val();
        
        $.ajax({
            url: "/blogposts/profile/editprofile",
            method: 'POST',
            data: {name,username,email,job,bio},
            dataType: 'html', // Assuming your comments are returned as HTML
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Replace the comments section with the new data
                $('body').html(data);
            },
        });
    }

    const $avatarImage = $('#avatarImage');
    const $avatarInput = $('#avatarInput');

    // Listen for changes in the file input
    $avatarInput.change(function () {
        const selectedFile = this.files[0];

        if (selectedFile) {
            // Create a URL for the selected file
            const objectURL = URL.createObjectURL(selectedFile);

            // Update the image source to display the selected file
            $avatarImage.attr('src', objectURL);
        }
    });

    // Listen for a click on the image to trigger the file input
    $avatarImage.click(function () {
        $avatarInput.click();
    });

    $('#passwordForm').validate({
        submitHandler: function(uform) {
            var oldPassword = $('#oldPassword').val();
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();
            var formData = new FormData(uform);

            // Log individual form field values to the console
            console.log('oldPassword:', oldPassword);
            console.log('newPassword:', newPassword);
            console.log('confirmNewPassword:', confirmNewPassword);

            $.ajax({
                url: "/blogposts/profile/editpassword",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('body').html(data);
                },
                error: function (data) {
                    showPasswordError();
                }
            });
        }
    });

    function showPasswordError() {

        var oldPassword = $('#oldPassword').val();
        var newPassword = $('#newPassword').val();
        var confirmNewPassword = $('#confirmNewPassword').val();
        
        $.ajax({
            url: "/blogposts/profile/editpassword",
            method: 'POST',
            data: {oldPassword,newPassword,confirmNewPassword},
            dataType: 'html', // Assuming your comments are returned as HTML
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Replace the comments section with the new data
                $('body').html(data);
            },
        });
    }

});



