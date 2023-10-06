         $(document).ready(function () {
            // JavaScript to toggle the dropdown
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
        });
