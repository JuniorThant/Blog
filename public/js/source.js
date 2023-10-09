$(document).ready(function(){

    //-------------------- admin ---------------------------//

    $('#searchcategoryButton').click(function (e) {
        var searchcategory = $('[name="searchcategory"]').val();
        // Make an Ajax request to load category-related posts
        $.ajax({
            type: 'POST',
            url: '/admin/category/create', // Use your existing blog posts route
            data: {
                searchcategory: searchcategory,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update the content of the container with the new posts
                $('body').html(data);
    
                // Update the browser's address bar with the new URL
 

            }
        });
        e.preventDefault();
    });

    $('#searchuserButton').click(function (e) {
        var search = $('[name="search"]').val();
    
        // Make an Ajax request to load user-related posts
        $.ajax({
            type: 'POST',
            url: '/admin/users/index', // Use your existing blog posts route
            data: {
                search: search,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update the content of the container with the new posts
                $('body').html(data);
    
                // Update the browser's address bar with the new URL
                var newUrl = '/admin/users/index?search=' + search;
history.pushState({ search: search }, '', newUrl);

            }
        });
        e.preventDefault();
    });

    //-------------------- blog ---------------------------//

    const dropdownButton = document.querySelector('.dropdown-button');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdownButton.addEventListener('click', function () {
        if (dropdownContent.style.display === 'block') {
            dropdownContent.style.display = 'none';
        } else {
            dropdownContent.style.display = 'block';
        }
    });

    // Close the dropdown when clicking outside of it
    window.addEventListener('click', function (event) {
        if (!event.target.matches('.dropdown-button')) {
            dropdownContent.style.display = 'none';
        }
    });

    $('.category-link').click(function (e) {
        var category = $(this).data('category');
        var search = new URLSearchParams(window.location.search).get('search'); // Get the current search parameter


        // Make an Ajax request to load category-related posts
        $.ajax({
            type: 'POST',
            url: '/blogposts', // Use your existing blog posts route
            data: {
                category: category,
                search:search
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update the content of the container with the new posts
                $('body').html(data);

               // Update the browser's address bar with the new URL
    var newUrl = '/blogposts?category=' + category + (search ? '&search=' + search : '');
    history.pushState({ category: category, search: search }, '', newUrl);
            }
        });
        e.preventDefault();
    });

    $('#searchButton').click(function (e) {
        var search = $('[name="search"]').val();
        var category = new URLSearchParams(window.location.search).get('category'); // Get the current category parameter
    
        // Make an Ajax request to load category-related posts
        $.ajax({
            type: 'POST',
            url: '/blogposts', // Use your existing blog posts route
            data: {
                search: search,
                category: category // Include the category parameter in the request
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update the content of the container with the new posts
                $('body').html(data);
    
                // Update the browser's address bar with the new URL
                var newUrl = '/blogposts?search=' + search + (category ? '&category=' + category : '');
                history.pushState({ search: search, category: category }, '', newUrl);
            }
        });
        e.preventDefault();
    });
    

    // Handle the back and forward buttons in the browser
    window.addEventListener('popstate', function (event) {
        // You can access the category from event.state.category
        var category = event.state.category;

        // Use the category to load the corresponding posts
        // Make an Ajax request or perform any necessary action

        // For example, you can trigger the category link click event
        // to load the posts for the selected category
        $('.category-link[data-category="' + category + '"]').click();
    });

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

     // Scroll to the element with id "success"
     var successElement = document.getElementById('success');
     var scrollstop = document.getElementById('scrollstop');
     if (successElement) {
         scrollstop.scrollIntoView({ behavior: 'smooth' });
         setTimeout(function() {
             // Hide the scrollstop element by setting its display property to "none"
             successElement.style.display = 'none';
         }, 5000); // 5000 milliseconds = 5 seconds
     }

    //-------------------- comment ---------------------------//

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

    //-------------------- profile ---------------------------//

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


    $('#updateprofileForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
    
        var formData = new FormData(this); // Create a FormData object from the form
    
        $.ajax({
            url: "/blogposts/profile/editprofile",
            method: 'POST',
            data: formData, // Use FormData for the data
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('body').html(data);
                $('.showSuccess').show();
                // Hide the success message after 5 seconds
            setTimeout(function() {
                $('.showSuccess').hide();
            }, 5000); // 5000 milliseconds = 5 seconds
            },
            error: function(data) {
                showProfileError();
            }
        });
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

    $('#passwordForm').submit(function(event){

        event.preventDefault(); // Prevent the default form submission
    
        var formData = new FormData(this); // Create a FormData object from the form

            // Log individual form field values to the console

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
                    $('.showSuccess').show();
                    // Hide the success message after 5 seconds
            setTimeout(function() {
                $('.showSuccess').hide();
            }, 5000); // 5000 milliseconds = 5 seconds
                },
                error: function (data) {
                    showPasswordError();
                }
            });
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

    //-------------------- reply ---------------------------//

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
        var filename = $('.commentForm [name="filename"]').val();
                
        $.ajax({
            url: "/article/" + filename,
            type: 'GET',
            success: function (data) {
                // Replace the comments section with the new data
                $('body').html(data);
                $('.replysection').show();
                $('.showWarning').show();
            },
        });
    }

    function showReplyEditError() {
        var filename = $('.commentForm [name="filename"]').val();
        var parentFindme2 = $(this).closest('.replyparent');
        var replyeditForm = parentFindme2.find('.replyeditsection');
        var warning=replyeditForm.find('.showWarning');
    
        $.ajax({
            url: "/article/" + filename,
            type: 'GET',
            success: function (data) {
                // Now you can use replyeditForm directly
                replyeditForm.show();
                $('.showWarning').show();
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
            $('.showWarning').hide();
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
                showReplyEditError()
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