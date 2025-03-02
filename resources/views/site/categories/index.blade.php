@extends('layouts.site_layout')

@section('title')
    سایت بازی | دسته بندی
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
                <h4 class="breadcrumb-title">دسته بندی</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}" target="_blank">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li>
                        دسته بندی
                    </li>
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
                                @foreach($main_categories as $cat)
                                    <li>
                                        <a href="{{route('site.category_index' , ['cat_id' => $cat['id']])}}">
                                            {{$cat['cat_title']}}
                                            <span>({{\App\Helper\GetCountCat::get_count_cat($cat['id'])}})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="col-md-12">
                        <div class="shop-sort">
                            <div class="shop-sort-box">
                                <div class="shop-sorty-label">
                                   دسته بندی ها
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop-item-wrapper item-3">
                        @if(!empty($categories->all()))
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="product-item">
                                            <div class="product-img">
                                                {{--                                        <span class="type">پرطرفدار</span>--}}
                                                <a href="{{route('site.category_detail',['cat_id' => $category['id']])}}">

                                                    <img src="{{asset($category['cat_image'])}}"
                                                         alt>
                                                </a>
                                                <div class="product-action-wrap">
                                                    <div class="product-action">
                                                        {{--                                                <a href="#" data-bs-toggle="modal" data-bs-target="#quickview"--}}
                                                        {{--                                                   data-tooltip="tooltip" title="نمایش سریع">--}}
                                                        {{--                                                    <i class="far fa-eye"></i>--}}
                                                        {{--                                                </a>--}}
                                                        <a href="{{route('site.product_detail',['product_id' => $category['id']])}}"
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
                                                    <a href="{{route('site.product_detail',['product_id' => $category['id']])}}">
                                                        {{$category['cat_title']}}
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
                                                        <span>{{number_format($category['product_price'])}} تومان</span>
                                                    </div>
                                                    <button type="button" class="product-cart-btn"
                                                            data-bs-placement="right"
                                                            data-tooltip="tooltip" title="افزودن به سبد خرید">
                                                        <i class="far fa-shopping-bag"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                    <p class="alert alert-info">
                                        محصولی ثبت نشده است
                                    </p>
                                @endif

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
@endsection
