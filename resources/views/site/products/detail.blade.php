@extends('layouts.site_layout')

@section('title')
    سایت بازی | جزئیات {{$product_info['product_name']}}
@endsection

@section('custom-css')
    <style>
        .tag_css {
            padding: 0 15px;
            margin: 0 5px;
            font-size: 10px;
            border-radius: 10px;
            box-shadow: 6px 6px 2px 1px rgba(0, 0, 255, .5);
        }
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        let product_quantity = $("#product_quantity");
        let cart_count_span = $("#cart_count_span");

        function show_sweetalert_msg(msg, icon) {
            new swal({
                html: "<p class='my_toast_txt'>" + msg + "</p>",
                toast: true,
                icon: icon,
                showConfirmButton: false,
                position: 'top',
                timerProgressBar: true,
                timer: 3500
            });
        }

        function checkInventory(tag) {
            let max = parseInt($(tag).attr('max'));
            let value = parseInt($(tag).val());

            if (value > max) {
                $(tag).val(max);
            }
        }

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }

            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function getCookie(name) {
            var cookieName = name + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var cookieArray = decodedCookie.split(';');

            for (var i = 0; i < cookieArray.length; i++) {
                var cookie = cookieArray[i];
                while (cookie.charAt(0) === ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cookieName) === 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }

            return null;
        }

        function addToCart(tag) {
            $(tag).prop('disabled', true);

            var cart_cookie = getCookie('cart');

            if (cart_cookie === null) {
                cart_cookie = new Date().getTime();
                setCookie('cart', cart_cookie, 60);
            }

            var data = {
                product_id: '{{$product_info['id']}}',
                count: product_quantity.val(),
                cookie: cart_cookie.toString(),
            };

            $.ajax({
                url: '{{route("api.addToCart")}}',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(data),
                headers: {
                    "Accept": "application/json"
                },
                success: function (response) {
                    if (response.error) {
                        show_sweetalert_msg(response.message, 'error');
                        if (response.refresh) {
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                    } else {
                        show_sweetalert_msg(response.message, 'success');
                        $(tag).prop('disabled', false);
                        cart_count_span.text(response.cart_count);
                    }
                },
                error: function (xhr, status, error) {
                    show_sweetalert_msg('خطای سمت سرور رخ داده است، لطفا دوباره تلاش کنید', 'error');
                }
            });
        }


    </script>

@endsection

@section('content')
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">جزئیات {{$product_info['product_name']}} </h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li>
                        <a href="{{route('site.products')}}">
                            <i class="far fa-shop"></i>
                            خرید آنلاین
                        </a>
                    </li>
                    <li class="active">
                        {{$product_info['product_name']}}
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="shop-single2 bg py-100">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-6 col-xxl-5">
                    <div class="shop-single-gallery" dir="ltr">
                        <div class="flexslider-thumbnails">
                            <ul class="slides">
                                <li data-thumb="{{asset(\App\Helper\GetProductMainImage::get_product_main_image($product_info['id']))}}"
                                    rel="adjustX:10, adjustY:">
                                    <img
                                        src="{{asset(\App\Helper\GetProductMainImage::get_product_main_image($product_info['id']))}}"
                                        alt="#">
                                </li>
                                @if($image_count > 0)
                                    @foreach($product_images_list as $image)
                                        <li data-thumb="{{asset($image['image_src'])}}">
                                            <img src="{{asset($image['image_src'])}}" alt="#" class="">
                                        </li>
                                    @endforeach
                                @else

                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xxl-6">
                    <div class="shop-single-info">
                        <h4 class="shop-single-title">
                            {{$product_info['product_name']}}
                        </h4>
                        <div class="shop-single-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="rating-count"> (4 نظر مشتری)</span>
                        </div>
                        <div class="shop-single-price">
                            {{--                            <del>690 تومان</del>--}}
                            <span class="amount">{{number_format($product_info['product_price'])}} تومان</span>
                            {{--                            <span class="discount-percentage">30% تخفیف</span>--}}
                        </div>
                        <p class="mb-3">
                            {{$product_info['product_meta_description']}}
                        </p>
                        <div class="shop-single-cs">
                            <div class="row">

                                {{--                                <div class="col-md-3 col-lg-4 col-xl-3">--}}
                                {{--                                    <div class="cart-single-size">--}}
                                {{--                                        <h6>اندازه</h6>--}}
                                {{--                                        <select class="select">--}}
                                {{--                                            <option value> انتخاب کنید</option>--}}
                                {{--                                            <option value="1">بسیار کوچک</option>--}}
                                {{--                                            <option value="2">کوچک</option>--}}
                                {{--                                            <option value="3">متوسط</option>--}}
                                {{--                                            <option value="4">بسیار بزرگ</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-md-6 col-lg-12 col-xl-6">--}}
                                {{--                                    <div class="cart-single-color">--}}
                                {{--                                        <h6>رنگ</h6>--}}
                                {{--                                        <ul class="cart-checkbox-list color">--}}
                                {{--                                            <li>--}}
                                {{--                                                <div class="form-check">--}}
                                {{--                                                    <input class="form-check-input" type="checkbox" id="color1">--}}
                                {{--                                                    <label class="form-check-label" for="color1"><span--}}
                                {{--                                                            style="background-color: #606ddd"></span></label>--}}
                                {{--                                                </div>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <div class="form-check">--}}
                                {{--                                                    <input class="form-check-input" type="checkbox" id="color2">--}}
                                {{--                                                    <label class="form-check-label" for="color2"><span--}}
                                {{--                                                            style="background-color: #4caf50"></span></label>--}}
                                {{--                                                </div>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <div class="form-check">--}}
                                {{--                                                    <input class="form-check-input" type="checkbox" id="color3">--}}
                                {{--                                                    <label class="form-check-label" for="color3"><span--}}
                                {{--                                                            style="background-color: #17a2b8"></span></label>--}}
                                {{--                                                </div>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <div class="form-check">--}}
                                {{--                                                    <input class="form-check-input" type="checkbox" id="color4">--}}
                                {{--                                                    <label class="form-check-label" for="color4"><span--}}
                                {{--                                                            style="background-color: #ffc107"></span></label>--}}
                                {{--                                                </div>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <div class="form-check">--}}
                                {{--                                                    <input class="form-check-input" type="checkbox" id="color5">--}}
                                {{--                                                    <label class="form-check-label" for="color5"><span--}}
                                {{--                                                            style="background-color: #f44336"></span></label>--}}
                                {{--                                                </div>--}}
                                {{--                                            </li>--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                        <div class="shop-single-sortinfo">
                            <ul>
                                <li> موجودی: <span>{{$product_info['inventory']}}</span></li>
                                {{--                                <li>کد محصول: <span>676TYWV</span></li>--}}
                                <li>
                                    دسته:
                                    <span>
                                    {{\App\Helper\GetCategoryTitle::get_category_title($product_info['cat_id'])}}
                                    </span>
                                </li>
                                <li>
                                    فروش توسط:
                                    <a href="#">
                                        سایت بازی
                                    </a>
                                </li>
                                <li>
                                    برچسب‌ها:
                                    @foreach($keywords as $tag)
                                        <a href="#" class="tag_css">
                                            {{$tag}}
                                        </a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="shop-single-action">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="shop-single-btn">
                                        <button onclick="addToCart(this)" type="submit" class="theme-btn">
                                            <span class="far fa-shopping-bag"></span>
                                            افزودن به سبد خرید
                                        </button>
                                        {{--                                        <a href="#" class="theme-btn theme-btn2" data-tooltip="tooltip"--}}
                                        {{--                                           title="اضافه کردن به علاقه مندی ها"><span class="far fa-heart"></span></a>--}}
                                        {{--                                        <a href="#" class="theme-btn theme-btn2" data-tooltip="tooltip"--}}
                                        {{--                                           title="افزودن به مقایسه"><span class="far fa-arrows-repeat"></span></a>--}}
                                    </div>
                                </div>
                                {{--                                <div class="col-md-6 col-lg-12 col-xl-6">--}}
                                {{--                                    <div class="cart-single-share">--}}
                                {{--                                        <span>اشتراک گذاری:</span>--}}
                                {{--                                        <a href="#"><i class="fab fa-facebook-f"></i></a>--}}
                                {{--                                        <a href="#"><i class="fab fa-twitter"></i></a>--}}
                                {{--                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>--}}
                                {{--                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-single-details">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#tab1"
                                type="button" role="tab" aria-controls="tab1" aria-selected="true">توضیحات
                        </button>
                        <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                                role="tab" aria-controls="tab2" aria-selected="false">اضافی
                            اطلاعات
                        </button>
                        <button class="nav-link" id="nav-tab3" data-bs-toggle="tab" data-bs-target="#tab3" type="button"
                                role="tab" aria-controls="tab3" aria-selected="false">بررسی ها
                            (05)
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="nav-tab1">
                        <div class="shop-single-desc">
                            <p>
                                {!! $product_info['product_content'] !!}
                            </p>

                            <div class="row">
                                <div class="col-lg-5 col-xl-4">
                                    <div class="shop-single-list">
                                        <h5 class="title">ویژگی ها</h5>
                                        <ul>
                                            <li>فیلم 4هزار30 و عکس های 30 مگاپیکسلی بگیرید</li>
                                            <li>کنترل کننده سبک بازی با صفحه لمسی</li>
                                            <li>فیلم 4هزار30 و عکس های 30 مگاپیکسلی بگیرید</li>
                                            <li>مشاهده فید دوربین زنده</li>
                                            <li>کنترل کامل هر06 مشکی</li>
                                            <li>از برنامه برای عملکرد دوربین اختصاصی استفاده کنید</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-5">
                                    <div class="shop-single-list">
                                        <h5 class="title">مشخصات</h5>
                                        <ul>
                                            <li><span>مواد:</span> چرم، پنبه، لاستیک، فوم</li>
                                            <li><span>سال مدل:</span> 1402</li>
                                            <li><span>اندازه‌های موجود:</span> 8.5، 9.0، 9.5، 10.0</li>
                                            <li><span>سازنده:</span> ریبوک.</li>
                                            <li><span>رنگ‌های موجود:</span> سفید/قرمز/آبی، سیاه/نارنجی/سبز</li>
                                            <li><span>ساخت:</span> ایالات متحده آمریکا</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="nav-tab2">
                        <div class="shop-single-additional">
                            <p>
                                انواع مختلف از معابر لورم آپسیوم وجود دارد، اما اکثریت
                                به نوعی تغییر می کند، با شوخی تزریقی، یا کلمات تصادفی که
                                حتی کمی باورپذیر به نظر نرسید اگر از یک پاساژ لورم استفاده کنید
                                ایپسوم، مطمئن باشید که هیچ چیز شرم آور در این وسط پنهان نشده است
                                تمام ژنراتورهای لورم اپسیوم در اینترنت متن به تکرار از پیش تعریف شده دارند
                                قطعات در صورت لزوم، این را به اولین مولد واقعی در اینترنت تبدیل می کند.
                            </p>
                            <p>
                                انواع مختلف از معابر لورم آپسیوم وجود دارد، اما اکثریت
                                به نوعی تغییر می کند، با شوخی تزریقی، یا کلمات تصادفی که
                                حتی کمی باورپذیر به نظر نرسید اگر از یک پاساژ لورم استفاده کنید
                                ایپسوم، مطمئن باشید که هیچ چیز شرم آور در این وسط پنهان نشده است
                                تمام ژنراتورهای لورم اپسیوم در اینترنت متن به تکرار از پیش تعریف شده دارند
                                قطعات در صورت لزوم، این را به اولین مولد واقعی در اینترنت تبدیل می کند.
                            </p>
                            <div class="shop-single-list">
                                <h5 class="title">گزینه های حمل و نقل:</h5>
                                <ul>
                                    <li><span>استاندارد:</span> 6-7 روز، هزینه ارسال - رایگان</li>
                                    <li><span>اکسپرس:</span> 1-2 روز، هزینه ارسال - 20 ریال</li>
                                    <li><span>پیک:</span> 2-3 روز، هزینه ارسال - 30 ریال</li>
                                    <li><span>فستگو:</span> 1-3 روز، هزینه ارسال - 15 ریال</li>
                                </ul>
                            </div>
                        </div>
                    </div>
{{--                    <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="nav-tab3">--}}
{{--                        <div class="shop-single-review">--}}
{{--                            <div class="blog-comments mb-0">--}}
{{--                                <h5>نظرات (05)</h5>--}}
{{--                                <div class="blog-comments-wrapper">--}}
{{--                                    <div class="blog-comments-single mt-0">--}}
{{--                                        <img src="assets/img/blog/com-1.jpg" alt="thumb">--}}
{{--                                        <div class="blog-comments-content">--}}
{{--                                            <h5>سینکلر دنولا</h5>--}}
{{--                                            <span><i class="far fa-clock"></i> 31 مهر 1402</span>--}}
{{--                                            <p>لورم اپسیوم به سادگی متن ساختگی چاپ و حروفچینی است--}}
{{--                                                صنعت. لورم اپسیوم متن ساختگی استاندارد این صنعت بوده است--}}
{{--                                                از زمانی که یک چاپگر ناشناس یک گالری از نوع را برداشت و آن را درهم ریخت--}}
{{--                                                برای ساختن یک کتاب نمونه نوع این نه تنها پنج قرن زنده مانده است--}}
{{--                                                بلکه حروفچینی الکترونیکی جهشی اساساً باقی مانده است--}}
{{--                                                صنعت. لورم اپسیوم متن ساختگی استاندارد این صنعت بوده است--}}
{{--                                                از زمانی که یک چاپگر ناشناس یک گالری از نوع را برداشت و آن را درهم ریخت--}}
{{--                                                برای ساختن یک کتاب نمونه نوع این نه تنها پنج قرن زنده مانده است--}}
{{--                                                اپسیوم.</p>--}}
{{--                                            <a href="#"><i class="far fa-reply"></i> پاسخ</a>--}}
{{--                                            <div class="review-rating">--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="blog-comments-single ms-md-5">--}}
{{--                                        <img src="assets/img/blog/com-2.jpg" alt="thumb">--}}
{{--                                        <div class="blog-comments-content">--}}
{{--                                            <h5>دانیل ولمن</h5>--}}
{{--                                            <span><i class="far fa-clock"></i> 31 مهر 1402</span>--}}
{{--                                            <p>لورم اپسیوم به سادگی متن ساختگی چاپ و حروفچینی است--}}
{{--                                                صنعت. لورم اپسیوم متن ساختگی استاندارد این صنعت بوده است--}}
{{--                                                از زمانی که یک چاپگر ناشناس یک گالری از نوع را برداشت و آن را درهم ریخت--}}
{{--                                                برای ساختن یک کتاب نمونه نوع این نه تنها پنج قرن زنده مانده است--}}
{{--                                                بلکه حروفچینی الکترونیکی جهشی اساساً باقی مانده است--}}
{{--                                                صنعت. لورم اپسیوم متن ساختگی استاندارد این صنعت بوده است--}}
{{--                                                از زمانی که یک چاپگر ناشناس یک گالری از نوع را برداشت و آن را درهم ریخت--}}
{{--                                                برای ساختن یک کتاب نمونه نوع این نه تنها پنج قرن زنده مانده است--}}
{{--                                                اپسیوم.</p>--}}
{{--                                            <a href="#"><i class="far fa-reply"></i> پاسخ</a>--}}
{{--                                            <div class="review-rating">--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="blog-comments-single">--}}
{{--                                        <img src="assets/img/blog/com-3.jpg" alt="thumb">--}}
{{--                                        <div class="blog-comments-content">--}}
{{--                                            <h5>کنت ایوانز</h5>--}}
{{--                                            <span><i class="far fa-clock"></i> 31 مهر 1402</span>--}}
{{--                                            <p> لورم اپسیوم به ساده متن ساختگی چاپ و حروفچینی است--}}
{{--                                                صنعت لورم اپسیوم متن ساختگی استاندارد این صنعت بوده است--}}
{{--                                                زمانی که یک چاپگر ناشناس یک گالری از نوعی را برداشت و آن را درهم ریخت--}}
{{--                                                برای ساختن یک کتاب نمونه نوع این نه تنها پنج قرن زنده مانده است--}}
{{--                                                بلکه حروفچینی الکترونیکی جهشی اساساً باقی مانده است--}}
{{--                                                صنعت لورم اپسیوم متن ساختگی استاندارد این صنعت بوده است--}}
{{--                                                زمانی که یک چاپگر ناشناس یک گالری از نوعی را برداشت و آن را درهم ریخت--}}
{{--                                                برای ساختن یک کتاب نمونه نوع این نه تنها پنج قرن زنده مانده است--}}
{{--                                                اپسیوم.</p>--}}
{{--                                            <a href="#"><i class="far fa-reply"></i> پاسخ</a>--}}
{{--                                            <div class="review-rating">--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                                <i class="fas fa-star"></i>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="blog-comments-form">--}}
{{--                                    <h4 class="mb-4">نظر بدهید</h4>--}}
{{--                                    <form action="#">--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="form-group review-rating">--}}
{{--                                                    <label>رتبه‌بندی شما</label>--}}
{{--                                                    <div>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="text" class="form-control" placeholder="نام شما*">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="email" class="form-control" placeholder="ایمیل شما*">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <input type="text" class="form-control" placeholder="موضوع شما*">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <select class="form-control form-select">--}}
{{--                                                        <option value>رتبه شما</option>--}}
{{--                                                        <option value="5">5 ستاره</option>--}}
{{--                                                        <option value="4">4 ستاره</option>--}}
{{--                                                        <option value="3">3 ستاره</option>--}}
{{--                                                        <option value="2">2 ستاره</option>--}}
{{--                                                        <option value="1">1 ستاره</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                     <textarea class="form-control" rows="5"--}}
{{--                                                               placeholder="نظر شما*"></textarea>--}}
{{--                                                </div>--}}
{{--                                                <button type="submit" class="theme-btn"><span--}}
{{--                                                        class="far fa-paper-plane"></span> ارسال نظر--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>


            <div class="seller-area pt-50 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="site-heading-inline">
                                <h2 class="site-title">همچنین در موجود است</h2>
                                <a href="#">مشاهده بیشتر <i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
{{--                    <div class="row">--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/01.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">فروشگاه سریع</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/02.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">خرید بورسلا</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/03.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">فروشگاه فرادل</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/04.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">فروشگاه لوریکا</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/05.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">فروشگاه مد</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/06.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">فروشگاه سریع</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/07.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">فروشگاه سباستین</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="seller-item">--}}
{{--                                <div class="seller-img">--}}
{{--                                    <a href="#"><img src="assets/img/seller/08.png" alt></a>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="seller-title">فروشگاه جیوروکس</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>


{{--            <div class="product-area related-item">--}}
{{--                <div class="container">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12">--}}
{{--                            <div class="site-heading-inline">--}}
{{--                                <h2 class="site-title">موارد مرتبط</h2>--}}
{{--                                <a href="#">مشاهده بیشتر <i class="fas fa-arrow-left"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6 col-lg-3">--}}
{{--                            <div class="product-item">--}}
{{--                                <div class="product-img">--}}
{{--                                    <span class="type new">جدید</span>--}}
{{--                                    <a href="shop-single.html"><img src="assets/img/product/p7.png" alt></a>--}}
{{--                                    <div class="product-action-wrap">--}}
{{--                                        <div class="product-action">--}}
{{--                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quickview"--}}
{{--                                               data-tooltip="tooltip" title="نمایش سریع"><i class="far fa-eye"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i--}}
{{--                                                    class="far fa-heart"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i--}}
{{--                                                    class="far fa-arrows-repeat"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="product-content">--}}
{{--                                    <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>--}}
{{--                                    <div class="product-rate">--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="product-bottom">--}}
{{--                                        <div class="product-price">--}}
{{--                                            <span>100.00 ریال</span>--}}
{{--                                        </div>--}}
{{--                                        <button type="button" class="product-cart-btn" data-bs-placement="right"--}}
{{--                                                data-tooltip="tooltip" title="افزودن به سبد خرید">--}}
{{--                                            <i class="far fa-shopping-bag"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 col-lg-3">--}}
{{--                            <div class="product-item">--}}
{{--                                <div class="product-img">--}}
{{--                                    <span class="type hot">داغ</span>--}}
{{--                                    <a href="shop-single.html"><img src="assets/img/product/p8.png" alt></a>--}}
{{--                                    <div class="product-action-wrap">--}}
{{--                                        <div class="product-action">--}}
{{--                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quickview"--}}
{{--                                               data-tooltip="tooltip" title="نمایش سریع"><i class="far fa-eye"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i--}}
{{--                                                    class="far fa-heart"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i--}}
{{--                                                    class="far fa-arrows-repeat"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="product-content">--}}
{{--                                    <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>--}}
{{--                                    <div class="product-rate">--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="product-bottom">--}}
{{--                                        <div class="product-price">--}}
{{--                                            <span>100.00 ریال</span>--}}
{{--                                        </div>--}}
{{--                                        <button type="button" class="product-cart-btn" data-bs-placement="right"--}}
{{--                                                data-tooltip="tooltip" title="اضافه کردت به سبد خرید">--}}
{{--                                            <i class="far fa-shopping-bag"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 col-lg-3">--}}
{{--                            <div class="product-item">--}}
{{--                                <div class="product-img">--}}
{{--                                    <span class="type oos">در انبار موجود نیست</span>--}}
{{--                                    <a href="shop-single.html"><img src="assets/img/product/p12.png" alt></a>--}}
{{--                                    <div class="product-action-wrap">--}}
{{--                                        <div class="product-action">--}}
{{--                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quickview"--}}
{{--                                               data-tooltip="tooltip" title="نمایش سریع"><i class="far fa-eye"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i--}}
{{--                                                    class="far fa-heart"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i--}}
{{--                                                    class="far fa-arrows-repeat"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="product-content">--}}
{{--                                    <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>--}}
{{--                                    <div class="product-rate">--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="product-bottom">--}}
{{--                                        <div class="product-price">--}}
{{--                                            <span>100.00 ریال</span>--}}
{{--                                        </div>--}}
{{--                                        <button type="button" class="product-cart-btn" data-bs-placement="right"--}}
{{--                                                data-bs-placement="right"--}}
{{--                                                data-tooltip="tooltip" title="افزودن به سبد خرید">--}}
{{--                                            <i class="far fa-shopping-bag"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 col-lg-3">--}}
{{--                            <div class="product-item">--}}
{{--                                <div class="product-img">--}}
{{--                                    <span class="type discount">10% تخفیف</span>--}}
{{--                                    <a href="shop-single.html"><img src="assets/img/product/p14.png" alt></a>--}}
{{--                                    <div class="product-action-wrap">--}}
{{--                                        <div class="product-action">--}}
{{--                                            <a href="#" data-bs-toggle="modal" data-bs-target="#quickview"--}}
{{--                                               data-tooltip="tooltip" title="نمایش سریع"><i class="far fa-eye"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="اضافه کردن به علاقه مندی ها"><i--}}
{{--                                                    class="far fa-heart"></i></a>--}}
{{--                                            <a href="#" data-tooltip="tooltip" title="افزودن برای مقایسه"><i--}}
{{--                                                    class="far fa-arrows-repeat"></i></a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="product-content">--}}
{{--                                    <h3 class="product-title"><a href="shop-single.html">ایرفون بلوتوث</a></h3>--}}
{{--                                    <div class="product-rate">--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="product-bottom">--}}
{{--                                        <div class="product-price">--}}
{{--                                            <del>120 ریال</del>--}}
{{--                                            <span>100.00 ریال</span>--}}
{{--                                        </div>--}}
{{--                                        <button type="button" class="product-cart-btn" data-bs-placement="right"--}}
{{--                                                data-bs-placement="right"--}}
{{--                                                data-tooltip="tooltip" title="افزودن به سبد خرید">--}}
{{--                                            <i class="far fa-shopping-bag"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

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
{{--        <div class="newsletter-img-1">--}}
{{--            <img src="assets/img/newsletter/01.png" alt>--}}
{{--        </div>--}}
{{--        <div class="newsletter-img-2">--}}
{{--            <img src="assets/img/newsletter/02.png" alt>--}}
{{--        </div>--}}
    </div>
@endsection
