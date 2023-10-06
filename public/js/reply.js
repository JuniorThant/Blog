$(document).ready(function(){
    $('.replySubmit').click(function() {
        var replySection = $(this).closest('.replysection');
        var replybody = replySection.find('.replybody').val();
        var comment_id = replySection.find('.comment_id').val();
        var filename = replySection.find('.rfilename').val();

        $.ajax({
            url: "/article/" + filename + "/replies",
            method: 'POST',
            data: { replybody, comment_id },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                showReplies();
            },
            error: function (error) {
                showReplyError();
            }
        });
    });
    

    function showReplyError() {
        var rfilename = $('.rfilename').val();
        var replybody=$('.replybody').val();
        
        $.ajax({
            url: "/article/" + rfilename + "/comments",
            method: 'POST',
            data:{replybody},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Replace the comments section with the new data
                $('body').html(data);
            },
        });
    }

    
    function showReplies() {
        var filename = $('.commentForm [name="filename"]').val();
        
        $.ajax({
            url: "/article/" + filename,
            type: 'GET',
            success: function (data) {
                // Replace the comments section with the new data
                $('body').html(data);
                $('.replycontainer').show();
            },
        });
    }

    $('.showReplySection').click(function() {
        var parentFindme = $(this).closest('.findme');
        var replySection = parentFindme.find('.replysection');
        
        if (replySection.is(':visible')) {
            replySection.hide();
        } else {
            $('.replysection').hide();
            replySection.show();
        }
    });

    $('.replyDropdown').click(function() {
        // Find the closest '.findme' section
        var parentFindme = $(this).closest('.findme');
        
        // Find the reply section within the closest '.findme' section
        var replySection = parentFindme.find('.replycontainer');

        // Toggle the reply section based on its current visibility
        if (replySection.is(':visible')) {
            replySection.slideUp(1000);
        } else {
            $('.replycontainer').slideUp(1000);
            replySection.slideDown(1000);
        }
    });

    
    $(document).on('click', function(event) {
        // Check if the clicked element is not inside .commentbox or .edittemplate
        if (!$(event.target).closest('.replycontainer').length && !$(event.target).closest('.replyedittemplate').length) {
            hideEditTemplate();
        }
    });

    $(".showreplyedittemplate").click(function(event) {
        event.stopPropagation(); // Prevent the click event from propagating to .comment-card
        console.log("Button clicked");
        var parentFindme = $(this).closest('.replyparent');
        var edittemplate = parentFindme.find('.replyedittemplate');
        var parentFindme2 = $(this).closest('.findme');
        var replyeditsection=parentFindme2.find('.replyeditsection');
        
        if (edittemplate.is(':visible')) {
            edittemplate.hide();
        } else {
            $('.replyedittemplate').hide();
            replyeditsection.hide();
            edittemplate.show();
        }
    });

      function hideEditTemplate() {
        $('.replyedittemplate').hide();
    }
    
    
    $('.editreply').click(function (event) {
        event.stopPropagation();
        var body = $(this).data('reply_body');
        var reply_id = $(this).data('reply_id');
        var parentFindme2 = $(this).closest('.replyparent');
        var replyeditForm = parentFindme2.find('.replyeditsection');
        var replyForm=parentFindme2.find('.replysection');

        var replyeditbody = replyeditForm.find('.replyeditbody');
        var newr_id = replyeditForm.find('.newr_id');
        console.log("reply:",body);
        console.log("ID:",reply_id);
        
        if (replyeditForm.is(':visible')) {
            replyeditForm.hide();
            replyForm.show();
        } else {
            $('.replyeditForm').hide();
            replyeditbody.val(body); // Set the value of the input
            newr_id.val(reply_id);
            replyeditForm.show();
            replyeditbody.focus();
            replyForm.hide();
        }
    });
    
    $('.replyeditsection').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission
    
        var replyeditbody = $('.replyeditbody').val();
        var newr_id = $('.newr_id').val();
        var urfilename = $('.urfilename').val();
        var formData = new FormData(this);
    
        // Log individual form field values to the console
        console.log('replyeditbody:', replyeditbody);
        console.log('newr_id:', newr_id);
    
        $.ajax({
            url: "/article/" + urfilename + "/replies/update",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                showReplies();
            },
            error: function (data) {
                showReplyError();
            }
        });
    });

    $('.deletereply').click(function(){
        var replycard = $(this).closest('.replyparent');
        var replyid = replycard.find('.replyid').text();
        var replyslug = replycard.find('.replyslug').text();
    
        $.ajax({
            url: "/article/" + replyslug + "/replies/delete",
            method: 'POST',
            data: { id: replyid },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                showReplies();
            },
            error: function(error) {
                showError();
            }
        });
    });
    
    // Window-level click event to hide edittemplate when clicking outside



})