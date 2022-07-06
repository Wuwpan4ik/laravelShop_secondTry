@extends('layouts.master')
@section('title')
    Главная страница
@endsection
@section('content')
    @foreach($errors->all() as $error)
        <div class="col-3 alert alert-danger">{{ $error }}</div>
    @endforeach
    <h1>Все товары</h1>
    <form method="GET" action="{{ route('index') }}">
        <div class="filters row">
            <div class="col-sm-6 col-md-3">
                <label for="price_from">Цена от
                    <input type="text" name="price_from" id="price_from" size="6" value="{{ request()->price_from  }}">
                </label>
                <label for="price_to">до
                    <input type="text" name="price_to" id="price_to" size="6"  value="{{ request()->price_to }}">
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="hit">
                    <input type="checkbox" name="hit" id="hit" @if(request()->hit) checked @endif> Хит
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="new">
                    <input type="checkbox" name="new" id="new" @if(request()->new) checked @endif> Новинка
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="recommended">
                    <input type="checkbox" name="recommended" id="recommended" @if(request()->recommended) checked @endif> Рекомендуем
                </label>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-primary">Фильтр</button>
                <a href="{{ route("index") }}" class="btn btn-warning">Сброс</a>
            </div>
        </div>
    </form>
    <div class="row">
        @foreach($products as $product)
            @include('layouts.card')
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
