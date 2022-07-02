@extends('layouts.master')
@section('title')
    {{ $category->name }}
@endsection
@section('content')
    <h1>
        {{ $category->name }}
    </h1>
    <p>
        {{ $category->description }}
    </p>
    <div class="row">
        @foreach($category->products as $product)
            @include('layouts.card')
        @endforeach
    </div>
@endsection
