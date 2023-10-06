$(document).ready(function(){
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
})
