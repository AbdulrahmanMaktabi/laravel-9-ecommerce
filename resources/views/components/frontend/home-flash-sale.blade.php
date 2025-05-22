<!--============================
        FLASH SELL START
    ==============================-->
<section id="wsus__flash_sell" class="wsus__flash_sell_2">
    <div class=" container">
        <div class="row">
            <div class="col-xl-12">
                <div class="offer_time" style="background: url({{ asset('frontend') }}/images/flash_sell_bg.jpg)">
                    <div class="wsus__flash_coundown">
                        <span class=" end_text">flash sell</span>
                        <div class="simply-countdown simply-countdown-one"></div>
                        <a class="common_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">

            @forelse ($products as $product)
                <div class="col-xl-3 col-sm-6 col-lg-4">
                    <div class="wsus__product_item">
                        <span class="wsus__new">New</span>
                        <span class="wsus__minus">{{ $product->discount }}%</span>
                        <a class="wsus__pro_link" href="{{ route('product.show', $product) }}">
                            <img src="{{ $product->image_url }}" alt="product" class="img-fluid w-100 img_1" />
                            <img src="{{ $product->image_url }}" alt="product" class="img-fluid w-100 img_2" />
                        </a>
                        <ul class="wsus__single_pro_icon">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                        class="fas fa-eye"></i></a></li>
                            <li><a href="#"><i class="fas fa-heart"></i></a></li>
                            <li><a href="#"><i class="fas fa-random"></i></a>
                        </ul>
                        <div class="wsus__product_details">
                            <a class="wsus__category" href="#">Electronics </a>
                            <p class="wsus__pro_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(133 review)</span>
                            </p>
                            <a class="wsus__pro_name" href="#">{{ $product->title }}</a>
                            <p class="wsus__price">
                                {{ Currency::format($product->compare_price) }}
                                <del>${{ $product->price }}</del>
                            </p>
                            <form action="{{ route('cart.store', $product->id) }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="1" name="qty">
                                <input class="add_cart" type="submit" value="add to cart">
                            </form>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse


        </div>
    </div>
</section>
<!--============================
        FLASH SELL END
    ==============================-->
