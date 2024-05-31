$(document).ready(function() {
    $('.cell').on('blur', function() {
        var row = $(this).data('row');
        var col = $(this).data('col');
        var value = $(this).val();
        updateCell(row, col, value);
    });

    $('.cell').on('input', function() {
        var selectedValue = $(this).val();
        $('#duplicateInput').val(selectedValue);
    });
});

function updateCell(row, col, value) {
    var url = $('#update-cell-url').data('url');
    var token = $('#csrf-token').val();
    
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            row: row,
            col: col,
            value: value,
            _token: token
        },
        success: function(response) {
            console.log('Ячейка успешно обновлена');
        },
        error: function(xhr, status, error) {
            console.error('Ошибка при обновлении ячейки', error);
        }
    });
}



