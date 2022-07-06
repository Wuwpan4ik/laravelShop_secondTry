@extends('layouts.master')
@section('title')
    Категории
@endsection
@section('content')
    @foreach($categories as $category)
        <div class="panel">
            <a href="{{ route('category', ['code' => $category->code]) }}">
                <h2>{{ $category->name }}</h2>
                <img src="{{ Storage::url($category->image) }}" alt="#" height="50px">
                <p style="color: black; text-decoration: none;">
                    {{ $category->description }}
                </p>
            </a>
        </div>
    @endforeach
@endsection
