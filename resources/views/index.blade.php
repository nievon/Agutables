@extends('layouts.app')

@section('content')
@if(!Auth::check())
<div class="container d-flex  justify-content-center">
    <h3 class="">Для начала пройдите авторизацию на сайте</h3>
</div>
<div class="container d-flex  justify-content-center">
    <a href="{{route('login')}}" class="btn btn-warning" style="width: 75px;">Войти</a>
</div>
@elseif(Auth::user()->isAdmin())
<h1 class="text-center display-4 ">Выбор таблицы</h1>
<div class="d-flex flex-column justify-content-center container ">
    <div class="dropdown open justify-content-center d-flex">
        <button class="btn btn-secondary dropdown-toggle" style="font-size: 36px;" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Список
        </button>
        <div class="dropdown-menu" aria-labelledby="triggerId">
            @foreach($tables as $tb)
            <a class="dropdown-item " style="font-size: 36px;" href="{{route('tables', $tb->id )}}">{{$tb->name}}</a>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center m-2">
        <a class="btn btn-success" style="font-size: 36px;" href="{{route('excel')}}">Excel</a>
    </div>
</div>

@elseif(Auth::user()->isModer())
<h1 class="text-center display-4 ">Выбор таблицы</h1>
<div class="d-flex flex-column justify-content-center container ">
    <div class="dropdown open justify-content-center d-flex">
        <button class="btn btn-secondary dropdown-toggle" style="font-size: 36px;" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Список
        </button>
        <div class="dropdown-menu" aria-labelledby="triggerId">
            @foreach($tables as $tb)
            <a class="dropdown-item " style="font-size: 36px;" href="{{route('tables', $tb->id )}}">{{$tb->name}}</a>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center m-2">
        <a class="btn btn-success" style="font-size: 36px;" href="{{route('excel')}}">Excel</a>
    </div>
</div>
@elseif(Auth::user()->isRedactor())
<h1 class="text-center display-4 ">Выбор таблицы</h1>
<div class="d-flex flex-column justify-content-center container ">

    <div class="d-flex justify-content-center m-2">
        <a class="btn btn-success" style="font-size: 36px;" href="{{route('excel')}}">Excel</a>
    </div>
</div>

@endif
@endsection