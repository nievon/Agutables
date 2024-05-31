@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{url('style/stylebtn.css')}}">
<div class="container">
    <div class="header-block bg-light py-4 mt-4 mb-5 rounded">
        <h1 class="display-4 text-center m-0">Книги, которыми с вами поделились</h1>
    </div>
    @if($books->isEmpty())
    <div class="alert alert-warning text-center" style="font-size: 1.5rem;" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        С вами не поделились ни одной книгой.
    </div>
    @else
    <div class="table-responsive mb-4">
        <table class="table table-striped table-hover table-custom m-0">
            <thead class="thead-dark">
                <tr>
                    <th>Владелец</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->user->name }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        <div class="btn-group-container">
                            <div class="btn-group">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-info m-1 bdrs">
                                    <i class="fas fa-eye"></i> Просмотр
                                </a>
                                @can('update', $book)
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning m-1 bdrs">
                                    <i class="fas fa-edit"></i> Редактировать
                                </a>
                                <a href="{{ route('books.download', $book) }}" class="btn btn-success m-1 bdrs">
                                    <i class="fas fa-download"></i> Скачать
                                </a>
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection