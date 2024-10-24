

$(document).ready(function () {
    const imageInput = $('#image-input');

    if (imageInput.length) { // 要素が存在するか確認
        imageInput.on('change', function (event) {
            const files = event.target.files;
            const previewContainer = $('#preview-container');
            previewContainer.empty(); // プレビューエリアをクリア

            if (files) {
                $.each(files, function (i, file) {
                    if (file.type.startsWith('image/')) {
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
            }
        });
    }
});

