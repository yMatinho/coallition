$(function () {

    function imagePreview(input, previewBox) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                previewBox.css({
                    'background-image': 'url(' + e.target.result + ')',
                    display: 'block'
                })
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('input[type=file]').change(function(e) {
        let idOfThePreviewBoxToShowImage = $(this).attr('preview_box_id')
        let previewBox = $('[preview_id="'+idOfThePreviewBoxToShowImage+'"]')

        imagePreview(this, previewBox)
    })
})
