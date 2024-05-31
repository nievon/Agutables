@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ url('style/stylebtn.css') }}">
<div class="container-fluid">
    <div class="header-block bg-light py-4 mt-4 mb-5 rounded">
        <h1 class="display-4 text-center m-0">Редактирование книги: {{ $book->title }}</h1>
    </div>
    <textarea id="duplicateInput" class="form-control mb-3" disabled style="font-size: 28px; overflow-y: auto;"></textarea>
    <div class="table-container" style="max-height: 750px; overflow-y: auto;">
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
<div id="update-cell-url" data-url="{{ route('books.updateCell', $book) }}"></div>
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
<script src="{{ url('JS/excel.js') }}"></script>
@endsection