<li class="header-cart-item flex-w flex-t m-b-12">
    <div class="header-cart-item-img">
        <img src="{{ $product->product_image }}" alt="{{ $product->product_image_name }}">
    </div>

    <div class="header-cart-item-txt p-t-8">
        <a href="{{ route('shop.show', ['product' => $product->id]) }}"
            class="header-cart-item-name m-b-18 hov-cl1 trans-04">
            {{ $product->product_name }}
        </a>

        <span class="header-cart-item-info">
            {{ $product->pivot->buy_quanlity }} x
            {{ '$' . number_format($product->price) }}
        </span>
    </div>
</li>
