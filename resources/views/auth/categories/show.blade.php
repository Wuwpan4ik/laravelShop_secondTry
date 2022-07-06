@extends('auth.layouts.master')

@section('title', 'Категория ' . $category->name)

@section('content')
    <div class="col-md-12">
        <h1>Категория {{ $category->name }}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $category->id }}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{ $category->code }}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{ $category->description }}</td>
            </tr>
            <tr>
                <td>Картикна</td>
                <td><img src="{{ $show }}" alt="#" height="100px"></td>
            </tr>
            <tr>
                <td>Количество товаров</td>
                <td>{{ $category->products->count() }}</td>
            </tr>
            </tbody>
        </table>
        <form action="{{ route('categories.destroy', $category) }}" method="POST">
            @csrf
            @method('DELETE')
            <a class="btn btn-warning" type="button" href="{{ route('categories.edit', $category) }}">Редактировать</a>
            <input class="btn btn-danger" type="submit" value="Удалить">
        </form>
@endsection
