@extends('layouts.master')
@section('title')
    Главная страница
@endsection
@section('content')
    <h1>Все товары</h1>
    <div class="row">
        @foreach($products as $product)
            @include('layouts.card')
        @endforeach
    </div>
@endsection
