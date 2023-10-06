 $(document).ready(function(){

    $('.like-button').click(function() {
        var button = $(this);
        var blogpostId = button.data('blogpost_id');
        var filename = button.data('filename');
        var isLiked = button.hasClass('liked');
    
        $.ajax({
            type: 'POST',
            url: isLiked ? '/article/' + filename + '/unlike' : '/article/' + filename + '/like',
            data: {
                blogpost_id: blogpostId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (isLiked) {
                    button.find('i').removeClass('bi bi-hand-thumbs-up-fill text-primary').addClass('bi bi-hand-thumbs-up');
                    button.removeClass('liked');
                } else {
                    button.find('i').removeClass('bi bi-hand-thumbs-up').addClass('bi bi-hand-thumbs-up-fill text-primary');
                    button.addClass('liked');
                }
                var likeCount = parseInt($('.like-count').text());
                $('.like-count').text(isLiked ? likeCount - 1 : likeCount + 1);
            }
        });
    });

    $(document).on('click', function(event) {
        // Check if the clicked element is not inside .commentbox or .edittemplate
        if (!$(event.target).closest('.findme2').length && !$(event.target).closest('.edittemplate').length) {
            hideEditTemplate();
        }
    });

        // Click event for comment-card
        $(".card-body").click(function() {
            console.log("Clicked");
                $(".edittemplate").hide();
                $(".commenteditForm").hide();
                $(".commentForm").show();
        });

        $(".showedittemplate").click(function(event) {
            event.stopPropagation(); // Prevent the click event from propagating to .comment-card
            console.log("Button clicked");
            var parentFindme = $(this).closest('.findme');
            var edittemplate = parentFindme.find('.edittemplate');
            
            if (edittemplate.is(':visible')) {
                edittemplate.hide();
            } else {
                $('.edittemplate').hide();
                edittemplate.show();
            }
        });
        

      function hideEditTemplate() {
        $('.edittemplate').hide();
        $('.commenteditForm').hide();
        $('.commentForm').show();
    }
    

    
    // Window-level click event to hide edittemplate when clicking outside

    $('.editComment').click(function (event) {
        event.stopPropagation();
        var body = $(this).data('comment_body');
        var comment_id = $(this).data('comment_id');
        var parentFindme2 = $(this).closest('.findme2');
        var commenteditForm = parentFindme2.find('.commenteditForm');
        var commentForm=parentFindme2.find('.commentForm');

        var edited_body = commenteditForm.find('.edited_body');
        var new_id = commenteditForm.find('.new_id');
        
        if (commenteditForm.is(':visible')) {
            commenteditForm.hide();
            commentForm.show();
        } else {
            $('.commenteditForm').hide();
            edited_body.val(body); // Set the value of the input
            new_id.val(comment_id);
            commenteditForm.show();
            edited_body.focus();
            commentForm.hide();
        }
    });
    
    $('#commenteditForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission
    
        var edited_body = $('.edited_body').val();
        var new_id = $('.new_id').val();
        var ufilename = $('.ufilename').val();
        var formData = new FormData(this);
    
        // Log individual form field values to the console
        console.log('edited_body:', edited_body);
        console.log('new_id:', new_id);
    
        $.ajax({
            url: "/article/" + ufilename + "/comments/update",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                showComments();
            },
            error: function (data) {
                showError();
            }
        });
    });
    

    
    $('.deleteComment').click(function() {
        var commentcard = $(this).closest('.findme');
        var id = commentcard.find('.commentid').text();
        var slug = commentcard.find('.slug').text();
        console.log("id",id);
        console.log("slug",slug);

        $.ajax({
            url: "/article/" + slug + "/comments/delete",
            method: 'POST',
            data:{id},
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

            
            function showComments() {
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


        // document.addEventListener('DOMContentLoaded', function() {
        //     // Get all elements with the class 'showReplySection'
        //     var replyButtons = document.querySelectorAll('.showReplySection');
        
        //     // Add click event listeners to each 'Reply' button
        //     replyButtons.forEach(function(button) {
        //         button.addEventListener('click', function() {
        //             // Find the closest '.findme' section
        //             var parentFindme = button.closest('.findme');
        
        //             // Find the reply section within the closest '.findme' section
        //             var replySection = parentFindme.querySelector('.replysection');
        
        //             // Toggle the reply section based on its current visibility
        //             if (replySection.style.display === 'block') {
        //                 replySection.style.display = 'none';
        //             } else {
        //                 // Hide all reply sections
        //                 var allReplySections = document.querySelectorAll('.replysection');
        //                 allReplySections.forEach(function(section) {
        //                     section.style.display = 'none';
        //                 });
        
        //                 // Show the reply section within the closest '.findme' section
        //                 replySection.style.display = 'block';
        //             }
        //         });
        //     });
        // });
       

    
        

            

        
        
        
          
          
          
          
        

          
        