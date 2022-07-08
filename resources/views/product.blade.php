@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="{{ Storage::url($product->image) }}" alt="#">
    <p>{{ $product->description }}</p>
    @if($product->isAvailable())
        <form action="{{ route('basket-add', $product) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
                В корзину
            </button>
        </form>
    @else
        <p><b>Товара нет в наличие</b></p>
        <form method="POST" action="{{ route('subscribe', compact('product')) }}">
            @csrf
            <input type="email" placeholder="email" value="{{ old('email') }}" name="email">
            <button type="submit">Сообщить о наличие</button>
        </form>
    @endif
@endsection
