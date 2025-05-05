<x-frontend.layout title="Product Details">



    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products details</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">product details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PRODUCT DETAILS START
    ==============================-->
    <section id="wsus__product_details">
        <div class="container">
            <div class="wsus__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                                        href="https://youtu.be/7m16dFI1AF8">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <ul class='exzoom_img_ul'>
                                        <li><img class="zoom ing-fluid w-100" src="{{ asset($product->image) }}"
                                                alt="product">
                                        </li>
                                        @forelse ($product->media as $image)
                                            <li><img class="zoom ing-fluid w-100" src="{{ asset($image) }}"
                                                    alt="product">
                                            </li>
                                        @empty
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-7 col-lg-7">
                        <div class="wsus__pro_details_text">
                            <a class="title" href="#">{{ $product->title }}</a>
                            <p class="wsus__stock_area"><span class="in_stock">in stock</span> (167 item)</p>
                            <h4>${{ $product->price }} <del>${{ $product->compare_price ?? $product->price }}</del>
                            </h4>
                            <p class="review">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>20 review</span>
                            </p>
                            <!-- <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia
                                neque
                                sint obcaecati asperiores dolor cumque. ad voluptate dolores reprehenderit hic adipisci
                                Similique eaque illum.</p> -->

                            <div class="wsus_pro_hot_deals">
                                <h5>offer ending time : </h5>
                                <div class="simply-countdown simply-countdown-one"></div>
                            </div>
                            {{-- <div class="wsus_pro_det_color">
                                <h5>color :</h5>
                                <ul>
                                    <li><a class="blue" href="#"><i class="far fa-check"></i></a></li>
                                    <li><a class="orange" href="#"><i class="far fa-check"></i></a></li>
                                    <li><a class="yellow" href="#"><i class="far fa-check"></i></a></li>
                                    <li><a class="black" href="#"><i class="far fa-check"></i></a></li>
                                    <li><a class="red" href="#"><i class="far fa-check"></i></a></li>
                                </ul>
                            </div>
                            <div class="wsus_pro__det_size">
                                <h5>size :</h5>
                                <ul>
                                    <li><a href="#">S</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">XL</a></li>
                                </ul>
                            </div> --}}
                            <div class="wsus__quentity">
                                <h5>quentity :</h5>
                                <form class="select_number">
                                    <input class="number_area" type="text" min="1" max="100"
                                        value="1" />
                                </form>
                                {{-- <h3>$50.00</h3> --}}
                            </div>
                            <div class="wsus__selectbox">
                                {{-- <div class="row">
                                    <div class="col-xl-6 col-sm-6">
                                        <h5 class="mb-2">select:</h5>
                                        <select class="select_2" name="state">
                                            <option>default select</option>
                                            <option>select 1</option>
                                            <option>select 2</option>
                                            <option>select 3</option>
                                            <option>select 4</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <h5 class="mb-2">select:</h5>
                                        <select class="select_2" name="state">
                                            <option>default select</option>
                                            <option>select 1</option>
                                            <option>select 2</option>
                                            <option>select 3</option>
                                            <option>select 4</option>
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                            <ul class="wsus__button_area">
                                <li><a class="add_cart" href="#">add to cart</a></li>
                                <li><a class="buy_now" href="#">buy now</a></li>
                                <li><a href="#"><i class="fal fa-heart"></i></a></li>
                                <li><a href="#"><i class="far fa-random"></i></a></li>
                            </ul>
                            <p class="brand_model"><span>model :</span> 12345670</p>
                            <p class="brand_model"><span>brand :</span> The Northland</p>
                            <div class="wsus__pro_det_share">
                                <h5>share :</h5>
                                <ul class="d-flex">
                                    <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                    <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <a class="wsus__pro_report" href="#" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"><i class="fal fa-comment-alt-smile"></i> Report
                                incorrect
                                product information.</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--============================
        PRODUCT DETAILS END
    ==============================-->

</x-frontend.layout>
