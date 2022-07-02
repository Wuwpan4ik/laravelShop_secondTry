<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} руб.</p>
            <form action="{{ route('basket-add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    В корзину
                </button>
            </form>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default"
                   role="button">Подробнее
                </a>
        </div>
    </div>
</div>

