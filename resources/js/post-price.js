
$(document).ready(function () {
    const $isPaidSelect = $('select[name="is_paid"]');
    const $priceContainer = $('#price-container');

    // ページロード時に選択状態を確認して表示
    togglePriceField($isPaidSelect.val());

    // 選択が変更されたときに表示を切り替え
    $isPaidSelect.on('change', function () {
        togglePriceField($(this).val());
    });

    function togglePriceField(value) {
        if (value === "1") {  // 有料が選択された場合
            $priceContainer.show();
        } else {  // 無料が選択された場合
            $priceContainer.hide();
        }
    }
});

