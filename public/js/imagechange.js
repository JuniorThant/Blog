$(document).ready(function(){

        const $avatarImage = document.getElementById('avatarImage');
        const $avatarInput = document.getElementById('avatarInput');

        $avatarInput.addEventListener('change', function () {
            const selectedFile = this.files[0];

            if (selectedFile) {
                const objectURL = URL.createObjectURL(selectedFile);
                $avatarImage.src = objectURL;
            }
        });

        $avatarImage.addEventListener('click', function () {
            $avatarInput.click();
        });

});

