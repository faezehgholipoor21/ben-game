@extends('layouts.site_layout')

@section('title')
    سایت بازی | جزئیات {{$cat_info['cat_title']}}
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
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 25px;
        }

        /* خود چک‌باکس */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* ظاهر سوئیچ */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 25px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 19px;
            width: 19px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }

        /* تغییر رنگ در حالت روشن */
        input:checked + .slider {
            background-color: #ce0414;
        }

        /* جابجایی دایره در حالت روشن */
        input:checked + .slider:before {
            transform: translateX(25px);
        }
        .force_div{
            background-color: #f27b91;
            display: inline-block;
            padding: 5px;
            border-radius: 10px;
            border-color: red;
            color: #000;
            font-size: 10px;
            line-height: 30px;
        }
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        let product_quantity = $("#product_quantity");
        let cart_count_span = $("#cart_count_span");

        const toggleSwitch = document.getElementById('toggleSwitch');
        const force_value = document.getElementById('force_value');

        // تغییر مقدار input مخفی بر اساس وضعیت سوئیچ
        toggleSwitch.addEventListener('change', () => {
            if (toggleSwitch.checked) {
                force_value.value = "1";
            } else {
                force_value.value = "0";
            }
        });



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
                product_id: '{{$cat_info['id']}}',
                count: product_quantity.val(),
                cookie: cart_cookie.toString(),
                force_value: force_value.value,
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
                <h4 class="breadcrumb-title">جزئیات {{$cat_info['cat_title']}} </h4>
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
                        {{$cat_info['cat_title']}}
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
                                <li data-thumb="{{asset($cat_info['cat_image'])}}"
                                    rel="adjustX:10, adjustY:">
                                    <img
                                        src="{{asset($cat_info['cat_image'])}}"
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
                            {{$cat_info['product_name']}}
                        </h4>
                        <div class="shop-single-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="rating-count"> (4 نظر مشتری)</span>
                        </div>

                        <p class="mb-3">
                            {{$cat_info['cat_meta_description']}}
                        </p>

                        <div class="shop-single-sortinfo">
                            <ul>
                                <li>
                                    دسته:
                                    <span>
                                    {{\App\Helper\GetCategoryTitle::get_category_title($cat_info['parent'])}}
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
                                        <button type="submit" class="theme-btn">
                                            <span class="far fa-shopping-bag"></span>
                                            نمایش محصولاتش
                                        </button>
                                    </div>
                                </div>
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
                                {!! $cat_info['cat_content'] !!}
                            </p>
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
        {{--        <div class="newsletter-img-1">--}}
        {{--            <img src="assets/img/newsletter/01.png" alt>--}}
        {{--        </div>--}}
        {{--        <div class="newsletter-img-2">--}}
        {{--            <img src="assets/img/newsletter/02.png" alt>--}}
        {{--        </div>--}}
    </div>
@endsection

