@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина</h1>
    <p>Оформление заказа</p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Название</th>
                <th>Кол-во</th>
                <th>Цена</th>
                <th>Стоимость</th>
            </tr>
            </thead>
            @foreach($order->products as $product)
            <tbody>
            <tr>
                <td>
                    <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                        <img height="56px" src="{{ Storage::url($product->image) }}" alt="#">
                        {{ $product->name }}
                    </a>
                </td>
                <td><span class="badge">{{ $product->pivot->count  }}</span>
                    <div class="btn-group form-inline">
                        <form action="{{ route('basket-remove', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                            </button>
                        </form>
                        <form action="{{ route('basket-add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </form>
                    </div>
                </td>
                <td>{{ $product->price }} руб.</td>
                <td>{{ $product->calculatePriceForCount() }} руб.</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">Общая стоимость:</td>
                <td>{{ $order->calculateFullPrice() }} руб.</td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-success" href="{{ route('basket-place') }}">Оформить заказ</a>
        </div>
    </div>
@endsection
