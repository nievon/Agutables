@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ url('style/stylebtn.css') }}">

<div class="container">
    <div class="header-block bg-light py-4 mt-4 mb-5 rounded">
        <h1 class="display-4 text-center m-0">Список пользователей</h1>
    </div>


    <div class="row justify-content-center">
        @foreach ($user as $us)
        <div class="col-md-4 d-flex justify-content-center">
            <div class="card m-3" style="width: 19rem;">
                <div class="card-body">
                    <h4 class="card-title text-center">ID: {{ $us->id }}</h4>
                    <h4 class="card-title">Имя: {{ $us->name }}</h4>
                    <p class="card-text">Почта: {{ $us->email }}</p>
                    <p class="card-text">Права: {{ $us->rule }}</p>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('adminpanel.rule', $us->id) }}" method="post" class="m-1">
                            @csrf
                            <input type="hidden" value="admin" name="role">
                            <button class="btn btn-info" style="font-size: 11px; height: 4rem; width: 5rem;">
                                <i class="fas fa-user-shield"></i> Сделать Админом
                            </button>
                        </form>
                        <form action="{{ route('adminpanel.rule', $us->id) }}" method="post" class="m-1">
                            @csrf
                            <input type="hidden" value="user" name="role">
                            <button class="btn btn-warning" style="font-size: 11px; height: 4rem; width: 5rem;">
                                <i class="fas fa-user-slash"></i> <br> Снять права
                            </button>
                        </form>

                        <form action="{{ route('adminpanel.user', $us->id) }}" method="post" class="m-1">
                            @csrf
                            <button class="btn btn-danger" style="font-size: 11px; height: 4rem; width: 5rem;">
                                <i class="fas fa-ban"></i> Забанить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection