$(document).ready(function(){
    $('#updateblogForm').validate({
        submitHandler: function(ubform) {
            var blogtitle = $('.blogtitle').val();
            var blogbody = $('.blogbody').val();
            var read_duration = $('.read_duration').val();
            var category_id = $('.category_id').val();
            var filename = $(ubform).find('[name="filename"]').val();
            var formData = new FormData(ubform);

            // Log individual form field values to the console
            console.log('blogtitle:', blogtitle);
            console.log('intro:', intro);
            console.log('blogbody:', blogbody);
            console.log('read_duration:', read_duration);
            console.log('category_id:', category_id);
            console.log('avatar:', formData.get('thumbnail')); // Log the selected thumbnail file

            $.ajax({
                url: "/article/edit/"+filename,
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
                    showError();
                }
            });
        }
    });

    function showError() {

        var blogtitle = $('.blogtitle').val();
        var blogbody = $('.blogbody').val();
        var read_duration = $('.read_duration').val();
        var category_id = $('.category_id').val();
        var filename = $('.commentForm [name="filename"]').val();
        
        $.ajax({
            url: "/article/edit/"+filename,
            method: 'POST',
            data: {blogtitle,intro,blogbody,read_duration,category_id},
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
})
