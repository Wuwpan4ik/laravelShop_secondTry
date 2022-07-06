@extends('auth.layouts.master')

@section('title', 'Товар ' . $product->name)

@section('content')
    <div class="col-md-12">
        <h1>Товар {{ $product->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $product->id }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $product->code }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $product->description }}</td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{ $product->category->name }}</td>
            </tr>
            <tr>
                <td>Цена</td>
                <td>{{ $product->price }}</td>
            </tr>
            <tr>
                <td>Картикна</td>
                <td><img src="#" alt="#" height="240px"></td>
            </tr>
            <tr>
                <td>Лейблы</td>
                <td>
                    @if($product->isNew())
                        <div class="badge badge-success">Новинка!</div>
                    @endif
                    @if($product->isRecommended())
                        <div class="badge badge-warning">Рекомендуемое</div>
                    @endif
                    @if($product->isHit())
                        <div class="badge badge-danger">Хит!</div>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
        <form action="{{ route('products.destroy', $product) }}" method="POST">
            @csrf
            @method('DELETE')
            <a class="btn btn-warning" type="button" href="{{ route('products.edit', $product) }}">Редактировать</a>
            <input class="btn btn-danger" type="submit" value="Удалить">
        </form>
@endsection
