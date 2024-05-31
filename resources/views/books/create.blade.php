@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{url('style/formstyle.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{url('style/stylebtn.css')}}">
<div class="container">
    <div class="header-block bg-light py-4 mt-4 mb-4 rounded">
        <h1 class="display-4 text-center m-0">Добавить книгу</h1>
    </div>
</div>
<div class="container mt-2 d-flex justify-content-center">

    <div class="form-wrapper">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Название книги</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="author">Автор</label>
                <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" required>
                @error('author')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group form-check align-center d-flex align-items-center">
                <input type="checkbox" class="form-check-input custom-checkbox" id="create_empty" name="create_empty">
                <label class="form-check-label ml-2" for="create_empty">Создать пустую книгу</label>
            </div>

            <div class="form-group" id="file-upload">
                <label for="file">Загрузить файл книги (Excel)</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file" name="file">
                </div>
                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Создать
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('create_empty').addEventListener('change', function() {
            var fileUpload = document.getElementById('file-upload');
            if (this.checked) {
                fileUpload.style.display = 'none';
                document.getElementById('file').removeAttribute('required');
            } else {
                fileUpload.style.display = 'block';
                document.getElementById('file').setAttribute('required', 'required');
            }
        });
    </script>
</div>

@endsection