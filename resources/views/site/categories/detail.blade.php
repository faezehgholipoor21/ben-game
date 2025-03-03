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
            box-shadow: 3px 2px 1px 0 rgba(0, 0, 255, .5);
        }

        .force_div {
            display: flex;
            align-items: center; /* هم‌تراز کردن عمودی چک‌باکس و متن */
            gap: 10px; /* فاصله بین چک‌باکس و متن */
            background-color: #6e2a2a;
            border-radius: 4px;
            color: #000;
            font-size: 10px;
            position: relative; /* برای نمایش متن توضیحی */
            padding: 9px 8px;
        }

        /* تنظیم ارتفاع input */
        input[name="force_price"] {
            height: 36px; /* برابر با دکمه‌ی سبد خرید */
            padding: 0 10px; /* فضای داخلی */
            box-sizing: border-box; /* برای محاسبه padding */
        }

        input[type="checkbox"] {
            width: 13px; /* عرض چک‌باکس */
            height: 13px; /* ارتفاع چک‌باکس */
            transform: scale(1.5); /* مقیاس‌بندی */
            margin-right: 5px; /* فاصله از متن */
            margin-left: 12px;
            cursor: pointer; /* نشانگر دست برای تجربه کاربری بهتر */
        }

        /* تنظیم دکمه‌ی سبد خرید */
        button {
            height: 36px; /* ارتفاع یکسان با input */
            display: flex;
            align-items: center; /* هم‌تراز کردن آیکون و متن */
            padding: 0 15px; /* فضای داخلی دکمه */
            gap: 5px; /* فاصله بین آیکون و متن */
        }


        .force_div > * {
            /*pointer-events: none; !* غیرفعال کردن تعامل با محتوای داخلی *!*/
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

        .account_css {
            border: 1px solid #0a58ca;
            border-radius: 10px;
            padding: 5px 10px;
            margin: 2px;
            color: #5c636a !important;
            font-size: 10px;
        }

        .account_p_css {
            background-color: #f6d3bd;
            padding: 5px;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
        }

        .user_acc_li {
            border: 2px solid #11b76b;
            border-radius: 10px;
            padding: 10px 15px;
            margin-bottom: 10px;
            background-color: #f8fffd;
        }

        .close_btn {
            background-color: #dd0628;
            border: none;
            border-radius: 5px;
            padding: 1px 6px;
            color: #fff;
            font-size: 14px;
        }

        form {
            display: flex;
            align-items: center; /* برای هم‌تراز کردن عمودی المان‌ها */
            gap: 10px; /* فاصله بین المان‌ها */
        }

        .force_label {
            display: flex;
            align-items: center;
        }

        .force_label span {
            color: #fff !important;
        }

        .force_inp {
            margin-right: 5px;
            margin-left: 5px;
        }
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('/vendor/sweetalert/sweetalert.all.js')}}"></script>

    <script>
        let account_fields = [];

        function ShowProductDetail(productId) {
            document.getElementById("product_modal_id").value = productId;

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

        function ShowAccountProductModal(product_id, cat_title, user_id) {
            const accountList = $('#account-list');

            account_fields = []
            let product_account_modal = $("#account_modal");
            let account_select = $("#accountSelect");
            product_account_modal.find('.loader').show()
            account_select.find('option').remove()
            account_select.hide()
            product_account_modal.modal('show');
            product_account_modal.find("#cat_name").text(cat_title);

            $.ajax({
                url: '{{route("site.get_product_account")}}', // URL برای دریافت اطلاعات محصول
                method: 'GET',
                data: {
                    id: product_id,
                    user_id: user_id
                },
                success: function (response) {
                    if (response.error === false) {
                        if (!response.error) {
                            const user_accounts = response.user_accounts;
                            let tr = '';
                            let li = '';
                            user_accounts.forEach(function (user_account) {
                                li += '<li class="user_acc_li">' + user_account.account.account_name;
                                tr = '<p> <input type="radio" name="user_acc_radio[]" value="' + user_account.account_id + '">';
                                user_account.user_account_details.forEach(function (user_acc) {
                                    tr += '<span class="badge bg-dark text-white m-1 px-2">' + user_acc.field_info.label + ': ' + user_acc.value + '</span>'
                                });
                                tr += '</p></li>'
                                li += tr
                            });

                            accountList.html(li);
                            accountList.find('input[name="user_acc_radio[]"]').first().prop('checked', true);
                            product_account_modal.find('.loader').hide();

                            $('#myModal').modal('show');
                        } else {
                            alert('خطا در دریافت اطلاعات.');
                        }
                    } else {
                        alert('یوزری موجود نیست');
                        modal_body.html('<p>محصولی یافت نشد.</p>');
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText); // بررسی خطا
                    modal_body.html('<p>خطا در دریافت اطلاعات.</p>');
                }
            });
        }

        function showAccountFields(tag) {
            $(tag).next().find('div').remove()
            let selected_option_index = $(tag).find('option:selected').index()

            let fields = account_fields[selected_option_index - 1]

            let the_field = ''
            for (let i = 0; i < fields.length; i++) {
                the_field = '<div class="col-12 mb-4">' +
                    '<label>' + fields[i]['label'] + '</label>' +
                    "<input type=\"" + fields[i]['type'] + "\" id=\"" + fields[i]['name'] + "\" class=\"form-control\">" +
                    '</div>'

                $(tag).next().append(the_field)
            }
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

            let p_id = $('')

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
                                    اکانت های مجاز :
                                    <span>
                                    @foreach($accounts as $account)
                                            <span class="tag_css">
                                        {{$account['account_name']}}
                                        </span>
                                        @endforeach
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
                                        <th>قیمت (تومان)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id="selected_product_tr">
                                        <td>
                                            <img class="w-100px rounded-2"
                                                 src="{{asset($product_info['product_image'])}}">
                                        </td>
                                        <td>
                                            <p class="p_name">
                                                {{$product_info['product_name']}}
                                            </p>
                                            <input type="hidden" class="p_id">
                                        </td>
                                        <td>
                                            <p class="p_price">
                                                {{@number_format(\App\Helper\ChangeDollar::change_dollar($product_info['product_price']))}}
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
                                            @if(\Illuminate\Support\Facades\Auth::user())
                                                <p onclick="ShowAccountProductModal({{$product_info['id']}} , '{{$cat_info['cat_title']}}' , '{{Auth::id()}}')"
                                                   id="product-ip" class="account_p_css"
                                                   data-product-id="{{$product_info['id']}}">
                                                    برای خرید لطفا ابتدا اکانت خود را وارد نمایید
                                                </p>
                                            @else
                                                <p class="alert alert-info">
                                                    <a href="{{route('site_login')}}">
                                                        لطفا ابتدا در سایت وارد شوید
                                                    </a>
                                                </p>
                                            @endif

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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

                <div class="modal-footer text-right">
                    <button type="button" class="close_btn" data-bs-dismiss="modal">
                        <i class="fa fa-close"></i>
                        انصراف
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="account_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route("api.addToCart")}}" method="POST">
                @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">انتخاب اکانت</h5>
                    <p class="modal-title title_css" id="cat_name"></p>
                </div>

                    <div class="modal-body">
                        <ul id="account-list">
                            <!-- لیست اکانت‌ها در اینجا قرار خواهد گرفت -->
                        </ul>
                        <p class="loader text-center fw-bold my-4">لطفا شکیبا باشید...</p>
                        <select onchange="showAccountFields(this)" class="form-control" id="accountSelect">
                            <option value="">در حال بارگذاری...</option>
                        </select>

                        <div class="row mt-4"></div>
                    </div>
                    <!-- فوتر مدال -->
                    <div class="modal-footer">
                        <button type="button" class="close_btn" data-bs-dismiss="modal">
                            <i class="fa fa-close"></i>
                            بستن
                        </button>

                        <div class="force_div">
                            <label class="force_label">
                                <input type="checkbox" name="is_force" class="force_inp">
                                <span>
                                 خرید فوری
                            </span>
                            </label>
                            <input type="hidden" value="{{$product_info['id']}}" name="product_id" id="product_modal_id">
                        </div>
                        <input type="hidden" value="{{$product_info['product_force_price']}}" name="force_price">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fa fa-shopping-bag"></i>
                            افزودن به سبد خرید
                        </button>

                    </div>

            </div>
            </form>

        </div>
    </div>
@endsection

