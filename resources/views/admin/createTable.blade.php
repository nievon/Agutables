@extends('layouts.app')

@section('content')
<div class="containers  ">
    <div class="form-wrapper">
        <h1>Создание таблицы</h1>
        <div class="row justify-content-center">
            <form action="{{route('adminpanel.addTables')}}" method="post" class="form">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" placeholder="Название таблицы">
                </div>
                <div class="form-group">
                    <input type="text" name="url" placeholder="URL">
                </div>
                <div class="form-group">
                    <button type="submit">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>


    .containers {
        
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
    }

    .form-wrapper {
        background-color: #fff;
        width: 600px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-wrapper h1 {
        margin-bottom: 30px;
        text-align: center;
        color: #007bff;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-group button {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 12px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }
</style>
@endsection