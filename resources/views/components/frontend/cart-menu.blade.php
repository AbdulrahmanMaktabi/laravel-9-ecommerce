<div class="wsus__mini_cart">
    <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
    <ul>
        @forelse ($items as $item)
            <li>
                <div class="wsus__cart_img">
                    <a href="#"><img src="{{ $item->product?->image }}" alt="{{ $item->product?->title }}"
                            class="img-fluid w-100"></a>
                    <a class="wsis__del_icon" href="#"><i class="fas fa-minus-circle"></i></a>
                </div>
                <div class="wsus__cart_text">
                    <a class="wsus__cart_title" href="#">{{ $item->product?->title }}</a>
                    <p>${{ $item->product?->price }}<del>${{ $item->product?->compare_price }}</del></p>
                </div>
            </li>
        @empty
        @endforelse
    </ul>
    <h5>total <span>${{ $total }}</span></h5>
    <div class="wsus__minicart_btn_area">
        <a class="common_btn" href="{{ route('cart.index') }}">view cart</a>
        <a class="common_btn" href="check_out.html">checkout</a>
    </div>
</div>
