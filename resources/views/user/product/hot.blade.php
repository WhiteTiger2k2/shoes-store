<div class="flashsale-block">
    <div class="wrapper-sale">
        <div class="box-list">
            <div class="box-head">
                <div class="head-title">
                    <h3>
                        Sản phẩm hot
                        <img style="max-width: 40px; max-height: 20px; padding-left: 10px;" alt="GIẢM SỐC 50%" src="images/hot-icon.png">
                    </h3>
                </div>
            </div>

            <!-- list-product -->
            <div class="list-product">
                <div class="slick-list">
                    <div class="slick-item row">
                        @foreach ($hotProducts as $product)
                        @php
                            $price = $product->price;
                            $discount = $product->discount;
                            $price_sale = $price - (($price * $discount) / 100 );
                        @endphp
                        <div class="col-lg-3 col-md-6 col-sm-12 product">
                            <div class="product-item card text-center">
                                <a href="{{ route('home.product', $product->id) }}" class="product-link">
                                    <div class="product-img">
                                        <img src="uploads/{{ $product->image }}" width="175" height="175" alt="">
                                    </div>
                                    <div class="text-center py-2">
                                        <h6 class="product-name">{{ $product->name }}</h6>
                                        <strong class="price">
                                            {{ number_format($price_sale, 0, '', '.') }}₫
                                            <span class="price-and-discount">
                                                <label class="price-old">
                                                    {{ number_format($product->price, 0, '', '.') }}₫
                                                </label>
                                                <small>-55%</small>
                                            </span>
                                        </strong>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-star"></small>
                                            <small class="fa fa-star text-star"></small>
                                            <small class="fa fa-star text-star"></small>
                                            <small class="fa fa-star text-star"></small>
                                            <small class="fa fa-star text-star"></small>
                                            <small>(99)</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="#" class="readmore-btn">
                <span>Xem tất cả</span>
            </a>
        </div>
    </div>
</div>