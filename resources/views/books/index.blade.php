@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ url('style/stylebtn.css') }}">
<div class="container">
    <div class="header-block bg-light py-4 mt-4 mb-5 rounded">
        <h1 class="display-4 text-center m-0">Мои книги</h1>
    </div>
    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('books.create') }}" class="btn btn-custom">
            <i class="fas fa-plus"></i> Добавить новую книгу
        </a>
        <a href="{{ route('books.sharedWithMe') }}" class="btn btn-custom">
            <i class="fas fa-share"></i> Книги по доступу
        </a>
    </div>
    @if($books->isEmpty())
    <div class="alert alert-success text-center" style="font-size: 1.5rem;" role="alert">
        <i class="fas fa-info-circle"></i>
        У вас нет таблиц. Добавьте новую таблицу!
    </div>
    @else
    <div class="table-responsive mb-4">
        <table class="table table-striped table-hover table-custom m-0">
            <thead class="thead-dark">
                <tr>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        <div class="btn-group-container">
                            <div class="btn-group">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-info m-1 bdrs">
                                    <i class="fas fa-eye"></i> Просмотр
                                </a>
                                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning m-1 bdrs">
                                    <i class="fas fa-edit"></i> Редактировать
                                </a>
                            </div>
                            <div class="btn-group">
                                <form action="{{ route('books.destroy', $book) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger m-1 bdrs">
                                        <i class="fas fa-trash"></i> Удалить
                                    </button>
                                </form>
                                <a href="{{ route('books.share', $book) }}" class="btn btn-secondary btn-sms m-1 bdrs">
                                    <i class="fas fa-share-alt"></i> Поделиться
                                </a>
                                <a href="{{ route('books.download', $book) }}" class="btn btn-success m-1 bdrs">
                                    <i class="fas fa-download"></i> Скачать
                                </a>
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
