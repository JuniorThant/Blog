$(document).ready(function(){

    $('#commentForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission
    
        var body = $('#body').val();
        var filename = $('[name="filename"]').val();
        var commentData = new FormData(this);
    
        console.log("Body:", body);
        console.log("filename:", filename);
    
        $.ajax({
            url: "/article/" + filename + "/comments",
            method: 'POST',
            processData: false,
            contentType: false,
            data: commentData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                showComments();
            },
            error: function (error) {
                showError();
            }
        });
    });
    
    

    function showError() {
        var filename = $('.commentForm [name="filename"]').val();
        
        $.ajax({
            url: "/article/" + filename + "/comments",
            method: 'POST',
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

    
    function showComments(e) {
       
        var filename = $('.commentForm [name="filename"]').val();
        
        $.ajax({
            url: "/article/" + filename,
            type: 'GET',
            success: function (data) {
                // Replace the comments section with the new data
                $('body').html(data);
            },
        });
    }

})