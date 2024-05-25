@extends('layouts.app')

@section('content')
<h1 class="text-center">Список пользователей</h1>
<div class="container d-flex  justify-content-center mb-2">
    <a class="btn btn-primary text-center" href="{{route('adminpanel.addTables')}}">Создать таблицу</a>
</div>
<div class="container">
    <div class="row justify-content-center">
        @foreach ($user as $us)
        <div class="col-md-4 d-flex justify-content-center">
            <div class="card m-3" style="width: 19rem;">
                <div class="card-body">
                    <h4 class="card-title text-center ">ID: {{ $us -> id }}</h4>
                    <h4 class="card-title">Имя: {{ $us -> name }}</h4>
                    <p class="card-text">Почта: {{ $us -> email }}</p>
                    <p class="card-text">Права: {{ $us -> rule }}</p>
                    <div class="d-flex">
                        <form action="{{route('adminpanel.rule', $us -> id)}}" method="post">
                            @csrf
                            <input type="hidden" value="admin" name="role">
                            <button class="btn btn-info m-1" style="font-size: 11px; height: 4rem; width: 5rem;">Сделать Админом</button>
                        </form>
                        <form action="{{route('adminpanel.rule', $us -> id)}}" method="post">
                            @csrf
                            <input type="hidden" value="moder" name="role">
                            <button class="btn btn-warning m-1 " style="font-size: 11px; height: 4rem; width: 5rem;">Сделать модером</button>
                        </form>
                        <form action="{{route('adminpanel.user', $us -> id)}}" method="post">
                            @csrf
                            <button class="btn btn-danger m-1 " style="font-size: 11px; height: 4rem; width: 5rem;">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection