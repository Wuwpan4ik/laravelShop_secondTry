<p>Уважаемый клиент, товар {{ $product->name }} появился в наличие</p>

<a href="{{ route('product', [$product->category->code, $product->code]) }}">Узнать подробности</a>
