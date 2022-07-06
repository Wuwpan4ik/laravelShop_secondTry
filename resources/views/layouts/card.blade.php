<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($product->isNew())
                <div class="badge badge-success">Новинка!</div>
            @endif
            @if($product->isRecommended())
                <div class="badge badge-warning">Рекомендуемое</div>
            @endif
            @if($product->isHit())
                <div class="badge badge-danger">Хит!</div>
            @endif
        </div>
        <img style="height: 150px" src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->price }} руб.</p>
            <form action="{{ route('basket-add', $product) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    В корзину
                </button>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}" class="btn btn-default"
                   role="button">Подробнее
                </a>
            </form>
        </div>
    </div>
</div>

