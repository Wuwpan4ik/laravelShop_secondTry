@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="{{ $product->image }}" alt="#">
    <p>{{ $product->description }}</p>
    <form action="{{ route('basket-add', $product) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">
            В корзину
        </button>
    </form>
@endsection
