

$(document).ready(function(){

    //-------------------- admin ---------------------------//

    $('#searchcategoryButton').click(function (e) {
        var searchcategory = $('[name="searchcategory"]').val();
        $.ajax({
            type: 'POST',
            url: '/admin/category/create', 
            data: {
                searchcategory: searchcategory,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('body').html(data);
            }
        });
        e.preventDefault();
    });

    $('#searchuserButton').click(function (e) {
        var search = $('[name="search"]').val();
        $.ajax({
            type: 'POST',
            url: '/admin/users/index', 
            data: {
                search: search,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('body').html(data);
                var newUrl = '/admin/users/index?search=' + search;
                history.pushState({ search: search }, '', newUrl);
            }
        });
        e.preventDefault();
    });


    //-------------------- blog ---------------------------//

    $('.category-link').click(function (e) {
        var category = $(this).data('category');
        var search = new URLSearchParams(window.location.search).get('search'); 
        $.ajax({
            type: 'POST',
            url: window.location.pathname, 
            data: {
                category: category,
                search:search
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('body').html(data);
                var newUrl = window.location.pathname+'?category=' + category + (search ? '&search=' + search : '');
                history.pushState({ category: category, search: search }, '', newUrl);
            }
        });
        e.preventDefault();
    });

    var successElement = document.getElementById('success');
    var scrollstop = document.getElementById('scrollstop');
    if (successElement) {
        scrollstop.scrollIntoView({ behavior: 'smooth' });
        setTimeout(function() {
            successElement.style.display = 'none';
        }, 5000); 
    }

    $('#searchButton').click(function (e) {
        var search = $('[name="search"]').val();
        var category = new URLSearchParams(window.location.search).get('category'); 
        $.ajax({
            type: 'POST',
            url: '/blogposts', 
            data: {
                search: search,
                category: category 
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('body').html(data);
                var newUrl = '/blogposts?search=' + search + (category ? '&category=' + category : '');
                history.pushState({ search: search, category: category }, '', newUrl);
            }
        });
        e.preventDefault();
    });
    


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
        if (!$(event.target).closest('.commentbox').length && !$(event.target).closest('.edittemplate').length) {
            hideCommentEditTemplate();
        }
    });


        $(".card-body").click(function() {
                $(".edittemplate").hide();
                $(".commenteditForm").hide();
                $(".commentForm").show();
        });

        $(".showedittemplate").click(function(event) {
            event.stopPropagation(); 
            var parentFindme = $(this).closest('.findme');
            var edittemplate = parentFindme.find('.edittemplate');
            
            if (edittemplate.is(':visible')) {
                edittemplate.hide();
            } else {
                $('.edittemplate').hide();
                edittemplate.show();
            }
        });
        

      function hideCommentEditTemplate() {
        $('.edittemplate').hide();
        $('.commenteditForm').hide();
        $('.commentForm').show();
    }

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
            edited_body.val(body); 
            new_id.val(comment_id);
            commenteditForm.show();
            edited_body.focus();
            commentForm.hide();
        }
    });
    
    $('#commenteditForm').submit(function (e) {
        e.preventDefault(); 
        var edited_body = $('.edited_body').val();
        var new_id = $('.new_id').val();
        var ufilename = $('.ufilename').val();
        var formData = new FormData(this);
    
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
                        $('body').html(data);
                    },
                });
            }

            $('#commentForm').submit(function (e) {
                e.preventDefault(); 
            
                var body = $('#body').val();
                var filename = $('[name="filename"]').val();
                var commentData = new FormData(this);
            
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
                    dataType: 'html', 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
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
                        $('body').html(data);
                    },
                });
            }

    //-------------------- profile ---------------------------//

    $('#linkPassword').click(function(e){
        $.ajax({
            type: 'GET',
            url: '/blogposts/profile/editpassword',
            success: function (data) {
                $('body').html(data);
                var newUrl = '/blogposts/profile/editpassword';
                history.pushState(null, null, newUrl);
            }
        });
        e.preventDefault();
    });

    $('#linkProfile').click(function(e){
        $.ajax({
            type: 'GET',
            url: '/blogposts/profile/editprofile', 
            success: function (data) {
                $('body').html(data);
                var newUrl = '/blogposts/profile/editprofile';
                history.pushState(null, null, newUrl);
            }
        });
        e.preventDefault();
    });


    $('#updateprofileForm').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this); 
    
        $.ajax({
            url: "/blogposts/profile/editprofile",
            method: 'POST',
            data: formData, 
            processData: false, 
            contentType: false, 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                $('body').html(data);
                $('.showSuccess').show();
            setTimeout(function() {
                $('.showSuccess').hide();
            }, 5000); 
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
            dataType: 'html', 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('body').html(data);
            },
        });
    }

    $('#passwordForm').submit(function(event){

        event.preventDefault(); 
        var formData = new FormData(this); 

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
            setTimeout(function() {
                $('.showSuccess').hide();
            }, 5000); 
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
            dataType: 'html', 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
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
    
        $.ajax({
            url: "/article/" + filename,
            type: 'GET',
            success: function (data) {
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
        var parentFindme = $(this).closest('.findme');
        var replySection = parentFindme.find('.replycontainer');
        if (replySection.is(':visible')) {
            replySection.slideUp(1000);
        } else {
            $('.replycontainer').slideUp(1000);
            replySection.slideDown(1000);
        }
    });

    
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.replyedittemplate').length) {
            hideEditTemplate();
        }
    });

    $(".showreplyedittemplate").click(function(event) {
        event.stopPropagation(); 
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
 
        if (replyeditForm.is(':visible')) {
            replyeditForm.hide();
            replyForm.show();
        } else {
            $('.replyeditForm').hide();
            replyeditbody.val(body); 
            newr_id.val(reply_id);
            replyeditForm.show();
            replyeditbody.focus();
            replyForm.hide();
        }
    });
    
    $('.replyeditsection').submit(function (e) {
        e.preventDefault(); 
    
        var urfilename = $('.urfilename').val();
        var formData = new FormData(this);
    
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



