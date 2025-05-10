<x-frontend.layout title="Cart page">
    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_status">
                                            status
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_tk">
                                            price
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn">clear cart</a>
                                        </th>
                                    </tr>
                                    @forelse ($cart as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset($item->product?->image) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{{ $item->product?->title }}</p>
                                                <span>color: red</span>
                                                <span>size: XL</span>
                                            </td>

                                            <td class="wsus__pro_status">
                                                <p>in stock</p>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <form action="{{ route('cart.update', ['cart' => $item]) }}"
                                                    method="post" class="select_number">
                                                    @method('put')
                                                    @csrf
                                                    @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                    <input class="number_area" type="text" min="1"
                                                        max="100" value="{{ $item->qty }}" name="qty" />
                                                    <input type="submit" value="update">
                                                </form>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>${{ $item->product?->price }}</h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="#"><i class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p>subtotal: <span>${{ $total }}</span></p>
                        <p>delivery: <span>$0</span></p>
                        <p>discount: <span>$0</span></p>
                        <p class="total"><span>total:</span> <span>${{ $total }}</span></p>

                        <form>
                            <input type="text" placeholder="Coupon Code">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('checkout.create') }}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="product_grid_view.html"><i
                                class="fab fa-shopify"></i> go shop</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--============================
          CART VIEW PAGE END
    ==============================-->
</x-frontend.layout>
