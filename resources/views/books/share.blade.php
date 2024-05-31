@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ url('style/formstyle.css') }}">
<script src="{{ url('JS/search.js') }}"></script>
<link rel="stylesheet" href="{{ url('style/stylebtn.css') }}">
<link rel="stylesheet" href="{{ url('style/serach.css') }}">
<div class="container">
    <div class="header-block bg-light py-4 mt-4 mb-5 rounded">
        <h1 class="display-4 text-center m-0">Поделиться книгой: {{ $book->title }}</h1>
    </div>

    <form action="{{ route('books.addUser', $book) }}" method="POST" class="container mb-5 d-flex justify-content-center">
        <div class="form-wrapper">
            @csrf
            <div class="form-group">
                <label for="searchTerm">Поиск пользователя</label>
                <input type="text" name="searchTerm" id="searchTerm" class="form-control" placeholder="Введите имя пользователя">
                <select id="searchResults" class="form-control mt-2" size="5" style="display: none;"></select>
                <input type="hidden" id="selectedUser" name="selectedUser">
                <div id="searchUrl" data-url="{{ route('search.users') }}"></div>
            </div>
            <div class="form-group">
                <label for="role">Роль</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="viewer">Просмотр</option>
                    <option value="editor">Редактирование</option>
                </select>
            </div>
            <div class="form-group form-actions">
                <div class="container d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-share-alt"></i> Поделиться</button>
                </div>
            </div>
        </div>
    </form>

    <div class="d-flex justify-content-center">
        <div class="header-block-min bg-light py-3 mb-5 rounded">
            <h2 class="text-center m-0">Пользователи с доступом</h2>
            <p class="lead text-center m-0">Список пользователей, которые имеют доступ к этой книге и их роли:</p>
        </div>
    </div>
    @if($sharedUsers->isNotEmpty())
    <div class="table-responsive">
        <table class="table table-striped table-hover table-custom m-0">
            <thead class="thead-dark">
                <tr>
                    <th>Пользователь</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sharedUsers as $sharedUser)
                <tr>
                    <td>{{ $sharedUser->name }}</td>
                    <td>{{ $sharedUser->pivot->role }}</td>
                    <td>
                        <div class="btn-group">
                            <form action="{{ route('books.removeUser', [$book, $sharedUser]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger m-1 bdrs">
                                    <i class="fas fa-trash"></i> Удалить доступ
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-success text-center" style="font-size: 1.5rem;" role="alert">
        <i class="fas fa-info-circle"></i>
        Пока нет пользователей с доступом к этой книге.
    </div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
@endsection