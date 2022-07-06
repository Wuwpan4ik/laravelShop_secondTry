@extends('layouts.master')
@section('title')
    {{ $category_info->name }}
@endsection
@section('content')
    <h1>
        {{ $category_info->name }}
    </h1>
    <p>
        {{ $category_info->description }}
    </p>
    <div class="row">
        @foreach($category as $product)
            @include('layouts.card')
        @endforeach
    </div>
@endsection
