$(document).ready(function(){
        const dropdownButton = document.querySelector('.dropdown-button');
        const dropdownContent = document.querySelector('.dropdown-content');

        dropdownButton.addEventListener('click', function () {
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            } else {
                dropdownContent.style.display = 'block';
            }
        });

        window.addEventListener('click', function (event) {
            if (!event.target.matches('.dropdown-button')) {
                dropdownContent.style.display = 'none';
            }
        });

        window.addEventListener('popstate', function (event) {
            var category = event.state.category;
            $('.category-link[data-category="' + category + '"]').click();
        });
});

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
