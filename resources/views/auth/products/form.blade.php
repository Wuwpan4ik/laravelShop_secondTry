@extends('auth.layouts.master')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
    </div>

    <form method="POST" enctype="multipart/form-data"
    @isset($product)
        action="{{ route('products.update', $product) }}"
    @else
          action="{{ route('products.store') }}"
    @endisset
    >
        @isset($product)
            @method('PUT')
        @endisset
        @csrf
            <div class="input-group row">
                <label for="code" class="col-sm-2 col-form-label">Код: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="code" id="code"
                           value="{{ old('code', isset($product) ? $product->code : null) }}">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                <div class="col-sm-6">
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id}}">{{ $cat->name  }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="name" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name"
                           value="{{ old('name', isset($product) ? $product->name : null) }}">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                <div class="col-sm-6">
                            <textarea name="description" id="description" cols="72"
                                      rows="7">{{ old('description', isset($product) ? $product->description : null) }}</textarea>
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" id="price"
                           value="{{ old('price', isset($product) ? $product->price : null) }}">
                </div>
            </div>
            <br>
            <div class="input-group row">
                <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">
                    <label class="btn btn-default btn-file">
                        Загрузить <input type="file" style="display: none;" name="image" id="image">
                    </label>
                </div>
            </div>

            <div class="input-group row">
                <label for="count" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="count" id="count"
                           value="{{ old('count', isset($product) ? $product->count : null) }}">
                </div>
            </div>

            @foreach([
                'hit' => 'Хиты',
                'new' => 'Новинки',
                'recommended' => 'Рекомендованное'
            ] as $field => $title)
                <div class="form-group row">
                    <label for="{{ $field }}" class="col-sm-2 col-form-label">{{ $title }}: </label>
                    <div class="col-sm-6">
                        <input type="checkbox" class="form-control" name="{{ $field }}" id="{{ $field }}"
                           @if(isset($product) && $product->$field === 1)
                               checked="checked"
                           @endif
                        >
                    </div>
                </div>
            @endforeach
            <button class="btn btn-success">Сохранить</button>
    </form>
    @foreach($errors->all() as $error)
        <div class="col-3 alert alert-danger">{{ $error }}</div>
    @endforeach
@endsection
