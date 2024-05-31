@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ url('style/stylebtn.css') }}">
<div class="container">
    <div class="header-block bg-light py-4 mt-4 mb-5 rounded">
        <h1 class="display-4 text-center m-0">Таблица: {{ $book->title }}</h1>
    </div>
    <div class="table-container" style="max-height: 750px; overflow-y: auto;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach($data[0] as $colIndex => $header)
                    <th>{{ chr(65 + $colIndex) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach(array_slice($data, 1) as $rowIndex => $row)
                <tr>
                    <th>{{ $rowIndex + 1 }}</th>
                    @foreach($row as $colIndex => $cell)
                    <td>{{ $cell }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection