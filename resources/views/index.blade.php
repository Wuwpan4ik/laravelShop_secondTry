@extends('layouts.master')
@section('title')
   : {{ __('main.main_page') }}
@endsection
@section('content')
    @foreach($errors->all() as $error)
        <div class="col-3 alert alert-danger">{{ $error }}</div>
    @endforeach
    <h1>{{ __('main.all_products') }}</h1>
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
                    <input type="checkbox" name="hit" id="hit" @if(request()->hit) checked @endif> {{ __('main.hit') }}
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="new">
                    <input type="checkbox" name="new" id="new" @if(request()->new) checked @endif> {{ __('main.new') }}
                </label>
            </div>
            <div class="col-sm-2 col-md-2">
                <label for="recommended">
                    <input type="checkbox" name="recommended" id="recommended" @if(request()->recommended) checked @endif> {{ __('main.recommend') }}
                </label>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-primary">{{ __('main.filter') }}</button>
                <a href="{{ route("index") }}" class="btn btn-warning">{{ __('main.reset') }}</a>
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
