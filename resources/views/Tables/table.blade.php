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
@foreach($table as $tb)
<h1 class="text-center ">{{$tb->name}}</h1>
<div class="card" style="height: 800px;">
    <div class="card-body">
        <iframe src="{{$tb->url}}" style="width: 100%; height: 100%;"></iframe>
    </div>
</div>
@endforeach
@elseif(Auth::user()->isModer())
@foreach($table as $tb)
<h1 class="text-center ">{{$tb->name}}</h1>
<div class="card" style="height: 800px;">
    <div class="card-body">
        <iframe src="{{$tb->url}}" style="width: 100%; height: 100%;"></iframe>
    </div>
</div>
@endforeach
@endif

@endsection