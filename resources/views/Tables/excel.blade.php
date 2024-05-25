@extends('layouts.app')

@section('content')
@if(!Auth::check())
<div class="container d-flex  justify-content-center">
    <h3 class="">Для начала пройдите авторизацию на сайте</h3>
</div>
<div class="container d-flex  justify-content-center">
    <a href="{{route('login')}}" class="btn btn-info" style="width: 75px;">Войти</a>
</div>
@elseif(Auth::user()->isAdmin())
<div class="mt-5">
    <h1 class="mb-4 text-center ">Редактировать Excel файл</h1>
    <textarea type="text" id="duplicateInput" class="form-control mb-3" disabled style="font-size: 28px; overflow-y: auto;"> </textarea>
    <div class="table-container" style="max-height: 750px; overflow-y: auto; background: #cfcfcf; border: 1px solid #aaa; border-radius: 5px; padding: 10px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach($data[0] as $colIndex => $header)
                    <th>{{ chr(64 + $colIndex) }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach(array_slice($data, 1) as $rowIndex => $row)
                <tr>
                    <th>{{ $rowIndex + 1 }}</th>
                    @foreach($row as $colIndex => $cell)
                    <td>
                        <input type="text" class="form-control cell" data-row="{{ $rowIndex + 1 }}" data-col="{{ $colIndex }}" value="{{ $cell }}" style="width: 15rem; height: 5rem; font-size: 24px;">
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@elseif(Auth::user()->isModer())
<div class="mt-5">
    <h1 class="mb-4 text-center ">Редактировать Excel файл</h1>
    <textarea type="text" id="duplicateInput" class="form-control mb-3" disabled style="font-size: 28px; overflow-y: auto;"> </textarea>
    <div class="table-container" style="max-height: 750px; overflow-y: auto; background: #cfcfcf; border: 1px solid #aaa; border-radius: 5px; padding: 10px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach(range(0, 2) as $colIndex)
                    <th>{{ chr(65 + $colIndex) }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach(array_slice($data, 1) as $rowIndex => $row)
                <tr>
                    @foreach(range(0, 2) as $colIndex)
                    <td>
                        <input type="text" class="form-control cell" data-row="{{ $rowIndex + 1 }}" data-col="{{ $colIndex }}" value="{{ $row[$colIndex] }}" style="max-width: 54rem; height: 5rem; font-size: 24px;">
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@elseif(Auth::user()->isRedactor())
<div class="mt-5">
    <h1 class="mb-4 text-center ">Редактировать Excel файл</h1>
    <textarea type="text" id="duplicateInput" class="form-control mb-3" disabled style="font-size: 28px; overflow-y: auto;"> </textarea>
    <div class="table-container" style="max-height: 750px; overflow-y: auto; background: #cfcfcf; border: 1px solid #aaa; border-radius: 5px; padding: 10px;">
        <table class="table table-bordered resizable">
            <thead>
                <tr>
                    @foreach($data[0] as $colIndex => $header)
                    <th>{{ chr(64 + $colIndex) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                $slicedData = array_slice($data, 1, 3); // Выбираем только первые три ряда данных
                @endphp
                @foreach($slicedData as $rowIndex => $row)
                <tr>
                    <th>{{ $rowIndex + 1 }}</th>
                    @foreach($row as $colIndex => $cell)
                    <td>
                        <input type="text" class="form-control cell" data-row="{{ $rowIndex + 1 }}" data-col="{{ $colIndex }}" value="{{ $cell }}" style="width: 15rem; height: 5rem; font-size: 24px;"> <!-- Вместо span используем input с атрибутом readonly -->
                    </td>
                    @endforeach
                </tr>
                @endforeach
                <!-- Здесь мы не выводим остальные ряды данных -->
            </tbody>
        </table>
    </div>
</div>


<style>
    .resizable {
        resize: horizontal;
        /* Разрешить изменение ширины по горизонтали */
        overflow-x: auto;
        /* Добавить горизонтальную прокрутку, если текст не помещается */
        white-space: nowrap;
        /* Предотвращает перенос строк */
    }
</style>


@endif
<style>
    .resizable {
        resize: horizontal;
        /* Разрешить изменение ширины по горизонтали */
        overflow-x: auto;
        /* Добавить горизонтальную прокрутку, если текст не помещается */
        white-space: nowrap;
        /* Предотвращает перенос строк */
    }
</style>
<style>
    .table-container::-webkit-scrollbar {
        width: 12px;
    }

    .table-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .table-container::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
        border: 3px solid #f1f1f1;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateCell(row, col, value) {
        $.ajax({
            url: '{{ route("update.cell") }}',
            method: 'POST',
            data: {
                row: row,
                col: col,
                value: value,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('кайфик)');
            },
            error: function(xhr, status, error) {
                console.error('ошибка', error);
            }
        });
    }

    $(document).ready(function() {
        $('.cell').on('blur', function() {
            var row = $(this).data('row');
            var col = $(this).data('col');
            var value = $(this).val();
            updateCell(row, col, value);
        });
    });
    $('.cell').on('input', function() {
        // Получаем значение выбранного инпута
        var selectedValue = $(this).val();
        // Устанавливаем значение дублирующего инпута равным значению выбранного инпута
        $('#duplicateInput').val(selectedValue);
    });
</script>
@endsection