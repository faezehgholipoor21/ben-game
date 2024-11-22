@extends('layouts.site_layout')

@section('title')
    سایت بازی | فروشگاه
@endsection

@section('custom-css')
@endsection

@section('custom-js')
@endsection

@section('content')
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">خرید آنلاین</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}" target="_blank">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="active">فروشگاه بازی ها</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="shop-area3 bg py-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="shop-widget">
                            <div class="shop-search-form">
                                <h4 class="shop-widget-title">جستجو</h4>
                                <form action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="جستجو کنید">
                                        <button type="search"><i class="far fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="shop-widget">
                            <h4 class="shop-widget-title">دسته</h4>
                            <ul class="shop-category-list">
                                @foreach($product_cat as $cat)
                                    <li>
                                        <a href="#">
                                            {{$cat['cat_title']}}
                                            <span>({{\App\Helper\GetCountCat::get_count_cat($cat['id'])}})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="shop-widget">
                            <h4 class="shop-widget-title">محدوده قیمت</h4>
                            <div class="price-range-box">
                                <div class="price-range-input">
                                    <input type="text" id="price-amount" readonly>
                                </div>
                                <div class="price-range"></div>
                            </div>
                        </div>
                        <div class="shop-widget">
                            <h4 class="shop-widget-title">فروش</h4>
                            <ul class="shop-checkbox-list">
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sale1">
                                        <label class="form-check-label" for="sale1">در حال فروش</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sale2">
                                        <label class="form-check-label" for="sale2">موجود در انبار</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sale3">
                                        <label class="form-check-label" for="sale3">در انبار موجود نیست</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="sale4">
                                        <label class="form-check-label" for="sale4">تخفیف</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-widget-banner mt-30 mb-50">
                            <div class="banner-img"
                                 style="background-image:url({{asset('site/assets/img/banner/cart-banner.jpg')}})"></div>
                            <div class="banner-content">
                                <h6><span>35% تخفیف</span></h6>
                                <h4>مجموعه جدید عینک آفتابی<br> دریافت کنید</h4>
                                <a href="#" class="theme-btn">اکنون خرید کنید</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="col-md-12">
                        <div class="shop-sort">
                            <div class="shop-sort-box">
                                <div class="shop-sorty-label">
                                    تمام محصولات
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-item-wrapper item-3">
                        <div class="row">
                            @foreach($product_list as $product)
                                <div class="col-md-6 col-lg-4">
                                    <div class="product-item">
                                        <div class="product-img">
                                            {{--                                        <span class="type">پرطرفدار</span>--}}
                                            <a href="{{route('site.product_detail',['product_id' => $product['id']])}}">

                                                <img src="{{asset(\App\Helper\GetProductMainImage::get_product_main_image($product['id']))}}"
                                                    alt>
                                            </a>
                                            <div class="product-action-wrap">
                                                <div class="product-action">
                                                    {{--                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview"--}}
                                                    {{--                                                   data-tooltip="tooltip" title="نمایش سریع">--}}
                                                    {{--                                                    <i class="far fa-eye"></i>--}}
                                                    {{--                                                </a>--}}
                                                    <a href="{{route('site.product_detail',['product_id' => $product['id']])}}"
                                                       data-tooltip="tooltip" title="نمایش سریع">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                    {{--                                                <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i--}}
                                                    {{--                                                        class="far fa-arrows-repeat"></i></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="product-title">
                                                <a href="{{route('site.product_detail',['product_id' => $product['id']])}}">
                                                    {{$product['product_name']}}
                                                </a>
                                            </h3>
                                            <div class="product-rate">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="product-bottom">
                                                <div class="product-price">
                                                    <span>{{number_format($product['product_price'])}} تومان</span>
                                                </div>
                                                <button type="button" class="product-cart-btn" data-bs-placement="right"
                                                        data-tooltip="tooltip" title="افزودن به سبد خرید">
                                                    <i class="far fa-shopping-bag"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{--                    <div class="pagination-area mb-0">--}}
                    {{--                        <div aria-label="نمونه پیمایش صفحه">--}}
                    {{--                            <ul class="pagination">--}}
                    {{--                                <li class="page-item">--}}
                    {{--                                    <a class="page-link" href="#" aria-label="Previous">--}}
                    {{--                                        <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                                <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
                    {{--                                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                    {{--                                <li class="page-item"><span class="page-link">...</span></li>--}}
                    {{--                                <li class="page-item"><a class="page-link" href="#">10</a></li>--}}
                    {{--                                <li class="page-item">--}}
                    {{--                                    <a class="page-link" href="#" aria-label="Next">--}}
                    {{--                                        <span aria-hidden="true"><i class="far fa-arrow-left"></i></span>--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>


    <div class="newsletter-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="newsletter-content">
                        <h3>دریافت کوپن تخفیف <span>20%</span></h3>
                        <p>با مشترک شدن در خبرنامه ما</p>
                        <div class="subscribe-form">
                            <form action="#">
                                <input type="email" class="form-control" placeholder="آدرس ایمیل معتبر شما">
                                <button class="theme-btn" type="submit">
                                    اشتراک <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newsletter-img-1">
            <img src="assets/img/newsletter/01.png" alt>
        </div>
        <div class="newsletter-img-2">
            <img src="assets/img/newsletter/02.png" alt>
        </div>
    </div>
@endsection
