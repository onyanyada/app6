

$(document).ready(function () {
    const imageInput = $('#bio-input');
    const previewContainer = $('#bio-preview');

    imageInput.on('change', function (event) {
        const file = event.target.files[0];

        // プレビュー領域をクリアする
        previewContainer.empty();

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = $('<img>').attr('src', e.target.result).css({
                    'max-width': '150px',
                    'margin-right': '10px',
                    'margin-bottom': '10px'
                });
                previewContainer.append(img);
            };
            reader.readAsDataURL(file);
        }
    });
});
