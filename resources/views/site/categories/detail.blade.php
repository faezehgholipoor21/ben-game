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
            background-color: #11B76B;
        }

        /* جابجایی دایره در حالت روشن */
        input:checked + .slider:before {
            transform: translateX(25px);
        }

        .force_div {
            background-color: #fff400;
            display: inline-block;
            border-radius: 10px;
            color: #000;
            font-size: 10px;
            position: relative; /* برای نمایش متن توضیحی */
            opacity: 0.5; /* ظاهر غیرفعال */
            cursor: not-allowed; /* نشانگر ورود ممنوع */
        }


        .force_div > * {
            pointer-events: none; /* غیرفعال کردن تعامل با محتوای داخلی */
        }

        .force_div::before {
            content: attr(data-tooltip); /* متن سفارشی */
            position: absolute;
            bottom: 120%; /* متن بالای دیو قرار گیرد */
            left: 50%; /* وسط دیو */
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8); /* رنگ پس‌زمینه متن */
            color: #fff; /* رنگ متن */
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 5px;
            white-space: nowrap; /* جلوگیری از شکستن متن */
            opacity: 0; /* مخفی بودن در حالت پیش‌فرض */
            pointer-events: none; /* جلوگیری از تعامل */
            transition: opacity 0.2s ease-in-out;
            z-index: 10; /* نمایش بالاتر از بقیه محتوا */
        }

        .force_div:hover::before {
            opacity: 1; /* متن ظاهر می‌شود */
            bottom: 110%; /* انیمیشن برای جابجایی جزئی */
        }

        .pro_img {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            text-decoration: none;
            color: inherit;
            border-radius: 10px;
            margin-left: 5px !important;
        }

        .pro_img img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .title_css {
            margin-right: 10px !important;
        }

        .w-100px {
            width: 100px;
        }

        #is_force_span {
            float: right;
            margin-top: 4px;
        }

        .account_css{
            border:1px solid #0a58ca;
            border-radius: 10px;
            padding: 5px 10px;
            margin: 2px;
            color: #5c636a !important;
            font-size: 10px;
        }
        .account_p_css{
            background-color: #f6d3bd;
            padding: 5px;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
        }
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        function ShowProductDetail(productId) {
            let selected_product_tr = $("#selected_product_tr")
            $.ajax({
                url: '{{route("site.get_product_detail")}}', // URL برای دریافت اطلاعات محصول
                method: 'GET',
                data: {
                    id: productId
                },
                success: function (response) {
                    if (!response.error) {
                        selected_product_tr.find('img').attr('src', response['product']['product_image'])
                        selected_product_tr.find('p.p_name').text(response['product']['product_name'])
                        selected_product_tr.find('p.p_price').text(response['product']['product_price'])
                        selected_product_tr.find('.p_id').val(response['product']['id'])
                        $('#is_force_span').text('خرید فوری ( ' + response['product']['product_force_price_seperated'] + ' تومان )')
                    }
                    $('#ProductModal').modal('hide');
                },
                error: function (error) {
                    console.log('خطا در بارگیری اطلاعات محصول', error);
                }
            });
        }

        let product_quantity = $("#product_quantity");
        let cart_count_span = $("#cart_count_span");

        const toggleSwitch = document.getElementById('toggleSwitch');
        const force_value = document.getElementById('force_value');

        toggleSwitch?.addEventListener('change', () => {
            if (toggleSwitch.checked) {
                force_value.value = "1";
            } else {
                force_value.value = "0";
            }
        });

        function ShowProductModal(id, cat_title) {
            let product_modal = $("#ProductModal");
            let modal_body = product_modal.find(".modal-body");

            product_modal.find("#cat_name").text(cat_title);
            modal_body.html('<p>در حال بارگذاری محصولات...</p>');

            $.ajax({
                url: `/get_products/${id}`,
                method: 'GET',
                success: function (response) {
                    if (response.length > 0) {
                        let productList = '<div class="product-list">';
                        response.forEach(product => {
                            productList += `
                        <button onclick="ShowProductDetail(${product.id})" class="product-item pro_img product-link w-100 border-0">
                            <img src="${product.product_image}" alt="${product.product_name}">
                            <div>
                                <p class="title_css" style="font-weight: bold;">${product.product_name}</p>
                                <p class="title_css" style="color: green;">${product.product_price} تومان</p>
                            </div>
                        </button>`;
                        });
                        productList += '</div>';
                        modal_body.html(productList);
                    } else {
                        modal_body.html('<p>محصولی یافت نشد.</p>');
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText); // بررسی خطا
                    modal_body.html('<p>خطا در دریافت اطلاعات.</p>');
                }
            });

            product_modal.modal('show');
        }

        function ShowAccountProductModal(product_id , cat_title){
            let product_account_modal = $("#account_modal") ;
            let account_select = $("#accountSelect") ;
            let modal_body = product_account_modal.find(".modal-body");

            product_account_modal.find("#cat_name").text(cat_title);
            modal_body.html('<p>در حال بارگذاری محصولات...</p>');

            $.ajax({
                url: '{{route("site.get_product_account")}}', // URL برای دریافت اطلاعات محصول
                method: 'GET',
                data: {
                    id: product_id
                },
                success: function (response) {
                    if (response.error === false) {
                        if (!response.error) {
                            // آرایه accounts را از response استخراج کنید
                            const accounts = response.accounts;

                            // گزینه‌های select را می‌سازیم
                            let options = '<option value="">انتخاب کنید</option>'; // گزینه پیش‌فرض
                            accounts.forEach(function(account) {
                                options += `<option value="${account.id}">${account.account_name}</option>`;
                            });

                            // مقدارهای ساخته‌شده را در select قرار دهید
                            $('#accountSelect').html(options);

                            // مودال را نمایش دهید
                            $('#myModal').modal('show');
                        } else {
                            alert('خطا در دریافت اطلاعات.');
                        }
                    } else {
                        modal_body.html('<p>محصولی یافت نشد.</p>');
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText); // بررسی خطا
                    modal_body.html('<p>خطا در دریافت اطلاعات.</p>');
                }
            });

            product_account_modal.modal('show');
        }

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
            let expires = "";
            if (days) {
                let date = new Date();
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

            let p_id = $('input.p_id')

            if (!p_id.val()) {
                location.reload()
                return false;
            }

            $(tag).prop('disabled', true);

            let cart_cookie = getCookie('cart');

            if (cart_cookie === null) {
                cart_cookie = new Date().getTime();
                setCookie('cart', cart_cookie, 60);
            }

            let data = {
                product_id: p_id.val(),
                count: product_quantity.val(),
                cookie: cart_cookie.toString(),
                force_value: $('#force_value').val()
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
                                        <button
                                            onclick="ShowProductModal({{$cat_info['id']}} , '{{$cat_info['cat_title']}}')"
                                            class="theme-btn w-75">
                                            <span class="far fa-shopping-bag"></span>
                                            نمایش محصولات
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive mt-4">
                                <table class="table table-bordered align-middle text-center">
                                    <thead>
                                    <tr>
                                        <th>تصویر</th>
                                        <th>نام محصول</th>
                                        <th>قیمت (ریال)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id="selected_product_tr">
                                        <td>
                                            <img class="w-100px rounded-2" src="{{asset($product_info['product_image'])}}">
                                        </td>
                                        <td>
                                            <p class="p_name">
                                                {{$product_info['product_name']}}
                                            </p>
                                            <input type="hidden" class="p_id">
                                        </td>
                                        <td>
                                            <p class="p_price">
                                                {{@number_format($product_info['product_price'])}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            حساب های مجاز
                                        </td>
                                        <td colspan="2">
                                            @foreach($product_info->accounts as $account)
                                                <span class="account_css text-black">
                                                    {{ $account->account_name }}
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p onclick="ShowAccountProductModal({{$product_info['id']}} , '{{$cat_info['cat_title']}}')" id="product-ip" class="account_p_css" data-product-id="{{$product_info['id']}}">
                                                    برای خرید لطفا ابتدا اکانت خود را وارد نمایید
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="force_div theme-btn clearfix" data-tooltip="لطفا اکانت انتخاب کنید">
                                        <label class="switch float-end ms-2">
                                            <input type="checkbox" id="toggleSwitch">
                                            <span class="slider"></span>
                                        </label>
                                        <input type="hidden" id="force_value" name="force_value" value="0">

                                        <span id="is_force_span">خرید فوری ({{@number_format($product_info['product_force_price']) . 'تومان'}})</span>
                                    </div>

                                    <button onclick="addToCart(this)" type="button" class="theme-btn" disabled="disabled">
                                        <span class="far fa-shopping-bag"></span>
                                        افزودن به سبد خرید
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
    </div>


    <!-- The Modal -->
    <div class="modal" id="ProductModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title title_css">نمایش محصولات</h4>
                    <p class="modal-title title_css" id="cat_name"></p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                </div>

                <!-- Modal footer -->

                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
            </div>
        </div>
    </div>

    <div class="modal" id="account_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title title_css">انتخاب اکانت مورد نظر</h4>
                    <p class="modal-title title_css" id="cat_name"></p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <select class="form-control" id="accountSelect">
                        <option value="">در حال بارگذاری...</option>
                    </select>
                </div>

                <!-- Modal footer -->

                <button type="button" class="btn btn-danger" data-dismiss="modal">انصراف</button>
            </div>
        </div>
    </div>
@endsection

