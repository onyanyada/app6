

$(document).ready(function () {
    const imageInput = $('#image-input');
    const previewContainer = $('#preview-container');
    let fileArray = [];

    imageInput.on('change', function (event) {
        const files = event.target.files;

        // ファイルを追加する
        $.each(files, function (i, file) {
            if (file.type.startsWith('image/')) {
                fileArray.push(file);  // 新しいファイルを配列に追加

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

        // inputの値をクリアして、再度同じファイルも選択できるようにする
        event.target.value = '';
    });

    // フォーム送信時にfileArrayの内容を送信
    $('form').on('submit', function (e) {
        e.preventDefault();  // デフォルトのフォーム送信を止める

        // FormDataを使ってファイルを送信する
        const formData = new FormData(this);

        // fileArray内のファイルをFormDataに追加
        $.each(fileArray, function (i, file) {
            formData.append('images[]', file);
        });

        // フォーム送信処理を追加する
        $.ajax({
            url: this.action, // フォームの送信先URL
            method: this.method, // フォームのメソッド
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // サーバーからのレスポンスでリダイレクト先URLを取得
                if (response.redirect) {
                    window.location.href = response.redirect;  // 手動でリダイレクト
                }
            },
            error: function (error) {
                // エラー時の処理
                console.log('エラー', error);
            }
        });
    });
});
