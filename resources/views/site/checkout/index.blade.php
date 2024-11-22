@extends('layouts.site_layout')

@section('title')
@endsection

@section('custom-css')
    <style>
        #my_full_screen_loader {
            width: 100%;
            height: 100%;
            position: fixed;
            right: 0;
            top: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
            display: none;
        }

        #my_full_screen_loader img {
            width: 200px;
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            left: 0;
            margin: auto;
        }
    </style>
@endsection

@section('custom-js')
    <script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    <script>
        let my_fullscreen_loader = $("#my_full_screen_loader");

    </script>
@endsection

@section('content')
    <div id="my_full_screen_loader">
        <img src="{{asset('site/assets/img/my_circlur_loader.svg')}}">
    </div>
    <div class="site-breadcrumb">
        <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
        <div class="container">
            <div class="site-breadcrumb-wrap">
                <h4 class="breadcrumb-title">تسویه حساب</h4>
                <ul class="breadcrumb-menu">
                    <li>
                        <a href="{{route('site.home')}}" target="_blank">
                            <i class="far fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="active">تسویه حساب</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-checkout py-100">
        <div class="container">
            <div class="shop-checkout-wrap">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shop-checkout-step">
                            <div class="accordion" id="shopCheckout">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#checkoutStep1" aria-expanded="true"
                                                aria-controls="checkoutStep1">
                                            اطلاعات کاربری
                                        </button>
                                    </h2>
                                    <div id="checkoutStep1" class="accordion-collapse collapse show"
                                         data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-form">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>نام</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$user_info['first_name']}}"
                                                                   placeholder="نام" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>نام خانوادگی</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$user_info['lastname']}}"
                                                                   placeholder="نام خانوادگی" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>ایمیل</label>
                                                            <input type="email" class="form-control"
                                                                   value="{{$user_info['email']}}"
                                                                   placeholder="آدرس ایمیل" dir="ltr" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>تلفن</label>
                                                            <input type="text" class="form-control"
                                                                   value="{{$user_info['mobile']}}"
                                                                   placeholder="شماره تلفن" dir="ltr" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <div id="checkoutStep2" class="accordion-collapse collapse"
                                         data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-check mb-20">
                                                                مقدار <input class="form-check-input" type="checkbox" .
                                                                             id="flexCheckDefault">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    آدرس پستی و حمل و نقل من یکسان است.
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>نام</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="نام">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>نام خانوادگی</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="نام خانوادگی">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>ایمیل</label>
                                                                <input type="email" class="form-control"
                                                                       placeholder="آدرس ایمیل">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>تلفن</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="شماره تلفن">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>خط 1 آدرس</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="خط 1 آدرس">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>خط 2 آدرس</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="خط 2 آدرس">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>کشور</label>
                                                                <select class="select">
                                                                    <option value>کشور را انتخاب کنید</option>
                                                                    <option value="AF">افغانستان</option>
                                                                    <option value="AX">جزایر آلاند</option>
                                                                    <option value="AL">آلبانی</option>
                                                                    <option value="DZ">الجزایر</option>
                                                                    <option value="AS">ساموآی آمریکا</option>
                                                                    <option value="AD">آندورا</option>
                                                                    <option value="AO">آنگولا</option>
                                                                    <option value="AI">آنگویلا</option>
                                                                    <option value="AQ">قطب جنوب</option>
                                                                    <option value="AG">آنتیگوا و باربودا</option>
                                                                    <option value="AR">آرژانتین</option>
                                                                    <option value="AM">ارمنستان</option>
                                                                    <option value="AW">آروبا</option>
                                                                    <option value="AU">استرالیا</option>
                                                                    <option value="AT">اتریش</option>
                                                                    <option value="AZ">آذربایجان</option>
                                                                    <option value="BS">باهاما</option>
                                                                    <option value="BH">بحرین</option>
                                                                    <option value="BD">بنگلادش</option>
                                                                    <option value="BB">باربادوس</option>
                                                                    <option value="BY">بلاروس</option>
                                                                    <option value="BE">بلژیک</option>
                                                                    <option value="BZ">بلیز</option>
                                                                    <option value="BJ">بنین</option>
                                                                    <option value="BM">برمودا</option>
                                                                    <option value="BT">بوتان</option>
                                                                    <option value="BO">بولیوی</option>
                                                                    <option value="BA">بوسنی و هرزگوین</option>
                                                                    <option value="BW">بوتسوانا</option>
                                                                    <option value="BV">جزیره بووه</option>
                                                                    <option value="BR">برزیل</option>
                                                                    <option value="IO">منطقه اقیانوس هند بریتانیا
                                                                    </option>
                                                                    <option value="VG">جزایر ویرجین بریتانیا</option>
                                                                    <option value="BN">برونئی</option>
                                                                    <option value="BG">بلغارستان</option>
                                                                    <option value="BF">بورکینافاسو</option>
                                                                    <option value="BI">بوروندی</option>
                                                                    <option value="KH">کامبوج</option>
                                                                    <option value="CM">کامرون</option>
                                                                    <option value="CA">کانادا</option>
                                                                    <option value="CV">کیپ ورد</option>
                                                                    <option value="KY">جزایر کیمن</option>
                                                                    <option value="CF">جمهوری آفریقای مرکزی</option>
                                                                    <option value="TD">چاد</option>
                                                                    <option value="CL">شیلی</option>
                                                                    <option value="CN">چین</option>
                                                                    <option value="CX">جزیره کریسمس</option>
                                                                    <option value="CC">جزایر کوکوس [کیلینگ]</option>
                                                                    <option value="CO">کلمبیا</option>
                                                                    <option value="KM">کومور</option>
                                                                    <option value="CG">کنگو - برازاویل</option>
                                                                    <option value="CD">کنگو - کینشاسا</option>
                                                                    <option value="CK">جزایر کوک</option>
                                                                    <option value="CR">کاستاریکا</option>
                                                                    <option value="CI">ساحل عاج</option>
                                                                    <option value="HR">کرواسی</option>
                                                                    <option value="CU">کوبا</option>
                                                                    <option value="CY">قبرس</option>
                                                                    <option value="CZ">جمهوری چک</option>
                                                                    <option value="DK">دانمارک</option>
                                                                    <option value="DJ">جیبوتی</option>
                                                                    <option value="DM">دومینیکا</option>
                                                                    <option value="DO">جمهوری دومینیکن</option>
                                                                    <option value="EC">اکوادور</option>
                                                                    <option value="EG">مصر</option>
                                                                    <option value="SV">السالوادور</option>
                                                                    <option value="GQ">گیینه استوایی</option>
                                                                    <option value="ER">اریتره</option>
                                                                    <option value="EE">استونی</option>
                                                                    <option value="ET">اتیوپی</option>
                                                                    <option value="FK">جزایر فالکلند</option>
                                                                    <option value="FO">جزایر فارو</option>
                                                                    <option value="FJ">فیجی</option>
                                                                    <option value="FI">فنلاند</option>
                                                                    <option value="FR">فرانسه</option>
                                                                    <option value="GF">گویان فرانسه</option>
                                                                    <option value="PF">پلی‌نزی فرانسه</option>
                                                                    <option value="TF">سرزمین های جنوبی فرانسه
                                                                    </option>
                                                                    <option value="GA">گابن</option>
                                                                    <option value="GM">گامبیا</option>
                                                                    <option value="GE">گرجستان</option>
                                                                    <option value="DE">آلمان</option>
                                                                    <option value="GH">غنا</option>
                                                                    <option value="GI">جبل الطارق</option>
                                                                    <option value="GR">یونان</option>
                                                                    <option value="GL">گرینلند</option>
                                                                    <option value="GD">گرنادا</option>
                                                                    <option value="GP">گوادلوپ</option>
                                                                    <option value="GU">گوام</option>
                                                                    <option value="GT">گواتمالا</option>
                                                                    <option value="GG">گرنزی</option>
                                                                    <option value="GN">گینه</option>
                                                                    <option value="GW">گیینه بیسائو</option>
                                                                    <option value="GY">گویان</option>
                                                                    <option value="HT">هائیتی</option>
                                                                    <option value="HM">هرد جزیره و مک دونالد
                                                                        جزایر
                                                                    </option>
                                                                    <option value="HN">هندوراس</option>
                                                                    <option value="HK">هنگ کنگ چین</option>
                                                                    <option value="HU">مجارستان</option>
                                                                    <option value="IS">ایسلند</option>
                                                                    <option value="IN">هند</option>
                                                                    <option value="ID">اندونزی</option>
                                                                    <option value="IR">ایران</option>
                                                                    <option value="IQ">عراق</option>
                                                                    <option value="IE">ایرلند</option>
                                                                    <option value="IM">جزیره من</option>
                                                                    <option value="IL">اسرائیل</option>
                                                                    <option value="IT">ایتالیا</option>
                                                                    <option value="JM">جامائیکا</option>
                                                                    <option value="JP">ژاپن</option>
                                                                    <option value="JE">جرسی</option>
                                                                    <option value="JO">اردن</option>
                                                                    <option value="KZ">قزاقستان</option>
                                                                    <option value="KE">کنیا</option>
                                                                    <option value="KI">کیریباتی</option>
                                                                    <option value="KW">کویت</option>
                                                                    <option value="KG">قرقیزستان</option>
                                                                    <option value="LA">لائوس</option>
                                                                    <option value="LV">لتونی</option>
                                                                    <option value="LB">لبنان</option>
                                                                    <option value="LS">لسوتو</option>
                                                                    <option value="LR">لیبریا</option>
                                                                    <option value="LY">لیبی</option>
                                                                    <option value="LI">لیختن اشتاین</option>
                                                                    <option value="LT">لیتوانی</option>
                                                                    <option value="LU">لوکزامبورگ</option>
                                                                    <option value="MO">ماکائو چین</option>
                                                                    <option value="MK">مقدونیه</option>
                                                                    <option value="MG">ماداگاسکار</option>
                                                                    <option value="MW">مالاوی</option>
                                                                    <option value="MY">مالزی</option>
                                                                    <option value="MV">مالدیو</option>
                                                                    <option value="ML">مالی</option>
                                                                    <option value="MT">مالتا</option>
                                                                    <option value="MH">جزایر مارشال</option>
                                                                    <option value="MQ">مارتینیک</option>
                                                                    <option value="MR">موریتانیا</option>
                                                                    <option value="MU">موریس</option>
                                                                    <option value="YT">مایوتی</option>
                                                                    <option value="MX">مکزیک</option>
                                                                    <option value="FM">میکرونزی</option>
                                                                    <option value="MD">مولداوی</option>
                                                                    <option value="MC">موناکو</option>
                                                                    <option value="MN">مغولستان</option>
                                                                    <option value="ME">مونته نگرو</option>
                                                                    <option value="MS">مونتسرات</option>
                                                                    <option value="MA">مراکش</option>
                                                                    <option value="MZ">موزامبیک</option>
                                                                    <option value="MM">میانمار [برمه]</option>
                                                                    <option value="NA">نامیبیا</option>
                                                                    <option value="NR">نائورو</option>
                                                                    <option value="NP">نپال</option>
                                                                    <option value="NL">هلند</option>
                                                                    <option value="AN">آنتیل هلند</option>
                                                                    <option value="NC">کالدونیای جدید</option>
                                                                    <option value="NZ">نیوزیلند</option>
                                                                    <option value="NI">نیکاراگوئه</option>
                                                                    <option value="NE">نیجر</option>
                                                                    <option value="NG">نیجریه</option>
                                                                    <option value="NU">نیو</option>
                                                                    <option value="NF">جزیره نورفولک</option>
                                                                    <option value="MP">جزایر ماریانای شمالی</option>
                                                                    <option value="KP">کره شمالی</option>
                                                                    <option value="NO">نروژ</option>
                                                                    <option value="OM">عمان</option>
                                                                    <option value="PK">پاکستان</option>
                                                                    <option value="PW">پالائو</option>
                                                                    <option value="PS">سرزمین های فلسطینی</option>
                                                                    <option value="PA">پاناما</option>
                                                                    <option value="PG">پاپوآ گینه نو</option>
                                                                    <option value="PY">پاراگوئه</option>
                                                                    <option value="PE">پرو</option>
                                                                    <option value="PH">فیلیپین</option>
                                                                    <option value="PN">جزایر پیتکرن</option>
                                                                    <option value="PL">لهستان</option>
                                                                    <option value="PT">پرتغال</option>
                                                                    <option value="PR">پورتوریکو</option>
                                                                    <option value="QA">قطر</option>
                                                                    <option value="RE">رئونیون</option>
                                                                    <option value="RO">رومانی</option>
                                                                    <option value="RU">روسیه</option>
                                                                    <option value="RW">روآندا</option>
                                                                    <option value="BL">سنت بارتلمی</option>
                                                                    <option value="SH">سنت هلنا</option>
                                                                    <option value="KN">سنت کیتس و نویس</option>
                                                                    <option value="LC">سنت لوسیا</option>
                                                                    <option value="MF">سنت مارتین</option>
                                                                    <option value="PM">سن پیر و میکلون
                                                                    </option>
                                                                    <option value="VC">سنت وینسنت و
                                                                        گرنادین ها
                                                                    </option>
                                                                    <option value="WS">ساموآ</option>
                                                                    <option value="SM">سن مارینو</option>
                                                                    <option value="ST">سائوتومه و پرنسیپ</option>
                                                                    <option value="SA">عربستان سعودی</option>
                                                                    <option value="SN">سنگال</option>
                                                                    <option value="RS">صربستان</option>
                                                                    <option value="SC">سیشل</option>
                                                                    <option value="SL">سیرا لئون</option>
                                                                    <option value="SG">سنگاپور</option>
                                                                    <option value="SK">اسلواکی</option>
                                                                    <option value="SI">اسلوونی</option>
                                                                    <option value="SB">جزایر سلیمان</option>
                                                                    <option value="SO">سومالی</option>
                                                                    <option value="ZA">آفریقای جنوبی</option>
                                                                    <option value="GS">گرجستان جنوبی</option>
                                                                    <option value="KR">کره جنوبی</option>
                                                                    <option value="ES">اسپانیا</option>
                                                                    <option value="LK">سری‌لانکا</option>
                                                                    <option value="SD">سودان</option>
                                                                    <option value="SR">سورینام</option>
                                                                    <option value="SJ">سوالبارد و یان ماین</option>
                                                                    <option value="SZ">سوازیلند</option>
                                                                    <option value="SE">سوئد</option>
                                                                    <option value="CH">سوئیس</option>
                                                                    <option value="SY">سوریه</option>
                                                                    <option value="TW">تایوان</option>
                                                                    <option value="TJ">تاجیکستان</option>
                                                                    <option value="TZ">تانزانیا</option>
                                                                    <option value="TH">تایلند</option>
                                                                    <option value="TL">تیمور شرقی</option>
                                                                    <option value="TG">توگو</option>
                                                                    <option value="TK">توکلائو</option>
                                                                    <option value="TO">تونگا</option>
                                                                    <option value="TT">ترینیداد و توباگو</option>
                                                                    <option value="TN">تونس</option>
                                                                    <option value="TR">ترکیه</option>
                                                                    <option value="TM">ترکمنستان</option>
                                                                    <option value="TC">جزایر تورکس و کایکوس</option>
                                                                    <option value="TV">تووالو</option>
                                                                    <option value="UG">اوگاندا</option>
                                                                    <option value="UA">اوکراین</option>
                                                                    <option value="AE">امارات متحده عربی</option>
                                                                    <option value="US">بریتانیا</option>
                                                                    <option value="UY">اروگوئه</option>
                                                                    <option value="UM">ایالات متحده جزایر دورافتاده کوچک
                                                                    </option>
                                                                    <option value="VI">ایالات متحده جزایر ویرجین
                                                                    </option>
                                                                    <option value="UZ">ازبکستان</option>
                                                                    <option value="VU">وانواتو</option>
                                                                    <option value="VA">شهر واتیکان</option>
                                                                    <option value="VE">ونزوئلا</option>
                                                                    <option value="VN">ویتنام</option>
                                                                    <option value="WF">والیس و فوتونا</option>
                                                                    <option value="EH">صحرای غربی</option>
                                                                    <option value="YE">یمن</option>
                                                                    <option value="ZM">زامبیا</option>
                                                                    <option value="ZW">زیمباوه</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>شهر</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="شهر">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>کد پستی</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="پست کد">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>وضعیت</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="وضعیت">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="shop-shipping-method">
                                                                <h6>روش ارسال را انتخاب کنید</h6>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                   name="روش" id="ssm-1" checked>
                                                                            <label class="form-check-label" for="ssm-1">
                                                                                استاندارد
                                                                                <span>هزینه ارسال - رایگان</span>
                                                                                <span>6-7 روز</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                   name="method" id="ssm-2">
                                                                            <label class="form-check-label" for="ssm-2">
                                                                                بیان
                                                                                <span>هزینه ارسال - 20 ریال</span>
                                                                                <span>1-2 روز</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                   name="method" id="ssm-3">
                                                                            <label class="form-check-label" for="ssm-3">
                                                                                پیک
                                                                                <span>هزینه ارسال - 30 ریال</span>
                                                                                <span>2-3 روز</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-4 col-xxl-3">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                   name="method" id="ssm-4">
                                                                            <label class="form-check-label" for="ssm-4">
                                                                                فستگو
                                                                                <span>هزینه ارسال - 15 ریال</span>
                                                                                <span>1-3 روز</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="button" class="theme-btn theme-btn2"><span
                                                                    class="fas fa-arrow-right"></span>قبلی
                                                            </button>
                                                            <button type="submit" class="theme-btn">مرحله بعدی<i
                                                                    class="fas fa-arrow-left"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#checkoutStep3"
                                                aria-expanded="false" aria-controls="checkoutStep3">
                                            اطلاعات پرداخت شما
                                        </button>
                                    </h2>
                                    <div id="checkoutStep3" class="accordion-collapse collapse show"
                                         data-bs-parent="#shopCheckout">
                                        <div class="accordion-body">
                                            <div class="shop-checkout-payment">
                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                    {{--                                                    <li class="nav-item" role="presentation">--}}
                                                    {{--                                                        <a class="nav-link active" id="pills-tab-1"--}}
                                                    {{--                                                           data-bs-toggle="pill" data-bs-target="#pills-1" type="button"--}}
                                                    {{--                                                           role="tab" aria-controls="pills-1" aria-selected="true">--}}
                                                    {{--                                                            <div class="checkout-card-img">--}}
                                                    {{--                                                                <img src="{{asset('site/assets/img/payment/mastercard.svg')}}" alt>--}}
                                                    {{--                                                                <img src="{{asset('site/assets/img/payment/visa.svg')}}" alt>--}}
                                                    {{--                                                                <img src="{{asset('site/assets/img/payment/amex.svg')}}" alt>--}}
                                                    {{--                                                                <img src="{{asset('site/assets/img/payment/discover.svg')}}" alt>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <span>پرداخت با کارت اعتباری</span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </li>--}}
                                                    {{--                                                    <li class="nav-item" role="presentation">--}}
                                                    {{--                                                        <a class="nav-link" id="pills-tab-2" data-bs-toggle="pill"--}}
                                                    {{--                                                           data-bs-target="#pills-2" type="button" role="tab"--}}
                                                    {{--                                                           aria-controls="pills-2" aria-selected="false">--}}
                                                    {{--                                                            <div class="checkout-payment-img">--}}
                                                    {{--                                                                <img src="assets/img/payment/paypal-2.svg" alt>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <span>پرداخت با پیپل</span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </li>--}}
                                                    {{--                                                    <li class="nav-item" role="presentation">--}}
                                                    {{--                                                        <a class="nav-link" id="pills-tab-3" data-bs-toggle="pill"--}}
                                                    {{--                                                           data-bs-target="#pills-3" type="button" role="tab"--}}
                                                    {{--                                                           aria-controls="pills-3" aria-selected="false">--}}
                                                    {{--                                                            <div class="checkout-payment-img">--}}
                                                    {{--                                                                <img src="assets/img/payment/payoneer.svg" alt>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <span>پرداخت با پایونر</span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </li>--}}
                                                    {{--                                                    <li class="nav-item" role="presentation">--}}
                                                    {{--                                                        <a class="nav-link" id="pills-tab-4" data-bs-toggle="pill"--}}
                                                    {{--                                                           data-bs-target="#pills-4" type="button" role="tab"--}}
                                                    {{--                                                           aria-controls="pills-4" aria-selected="false">--}}
                                                    {{--                                                            <div class="checkout-payment-img cod">--}}
                                                    {{--                                                                <img src="assets/img/payment/cod-3.svg" alt>--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            <span>تحویل به شکل پرداخت نقدی</span>--}}
                                                    {{--                                                        </a>--}}
                                                    {{--                                                    </li>--}}
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link" id="pills-tab-4" data-bs-toggle="pill"
                                                           data-bs-target="#pills-4" type="button" role="tab"
                                                           aria-controls="pills-4" aria-selected="false">
                                                            <div class="checkout-payment-img cod">
                                                                <img
                                                                    src="{{asset('site/assets/img/payment/zarinpal-logo-min.png')}}"
                                                                    alt>
                                                            </div>
                                                            <span>پرداخت زرین پال</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="pills-tabContent">
                                                    {{--                                                    <div class="tab-pane fade show active" id="pills-1" role="tabpanel"--}}
                                                    {{--                                                         aria-labelledby="pills-tab-1" tabindex="0">--}}
                                                    {{--                                                        <div class="shop-checkout-form">--}}
                                                    {{--                                                            <form action="#">--}}
                                                    {{--                                                                <div class="row">--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>نام دارنده کارت</label>--}}
                                                    {{--                                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                                   placeholder="نام صاحب کارت">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>شماره کارت</label>--}}
                                                    {{--                                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                                   placeholder="شماره کارت شما">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>تاریخ انقضا</label>--}}
                                                    {{--                                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                                   placeholder="تاریخ انقضا">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>سی سی وی</label>--}}
                                                    {{--                                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                                   placeholder="سی سی وی">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <button type="button"--}}
                                                    {{--                                                                                class="theme-btn theme-btn2"><span--}}
                                                    {{--                                                                                class="fas fa-arrow-right"></span>قبلی--}}
                                                    {{--                                                                        </button>--}}
                                                    {{--                                                                        <button type="submit" class="theme-btn">پرداخت--}}
                                                    {{--                                                                            اکنون<i class="fas fa-arrow-left"></i>--}}
                                                    {{--                                                                        </button>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </form>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                    <div class="tab-pane fade" id="pills-2" role="tabpanel"--}}
                                                    {{--                                                         aria-labelledby="pills-tab-2" tabindex="0">--}}
                                                    {{--                                                        <div class="shop-checkout-form">--}}
                                                    {{--                                                            <form action="#">--}}
                                                    {{--                                                                <div class="row">--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>آدرس ایمیل</label>--}}
                                                    {{--                                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                                   placeholder="Email">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>رمز عبور</label>--}}
                                                    {{--                                                                            <input type="password" class="form-control"--}}
                                                    {{--                                                                                   placeholder="Password">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <button type="submit" class="theme-btn">ورود شوید--}}
                                                    {{--                                                                            حساب<i class="fas fa-arrow-left"></i>--}}
                                                    {{--                                                                        </button>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </form>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                    <div class="tab-pane fade" id="pills-3" role="tabpanel"--}}
                                                    {{--                                                         aria-labelledby="pills-tab-3" tabindex="0">--}}
                                                    {{--                                                        <div class="shop-checkout-form">--}}
                                                    {{--                                                            <form action="#">--}}
                                                    {{--                                                                <div class="row">--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>آدرس ایمیل</label>--}}
                                                    {{--                                                                            <input type="text" class="form-control"--}}
                                                    {{--                                                                                   placeholder="Email">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <div class="form-group">--}}
                                                    {{--                                                                            <label>رمز عبور</label>--}}
                                                    {{--                                                                            <input type="password" class="form-control"--}}
                                                    {{--                                                                                   placeholder="Password">--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                    <div class="col-lg-6">--}}
                                                    {{--                                                                        <button type="submit" class="theme-btn">ورود شوید--}}
                                                    {{--                                                                            حساب<i class="fas fa-arrow-left"></i>--}}
                                                    {{--                                                                        </button>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </form>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                    <div class="tab-pane fade" id="pills-4" role="tabpanel"--}}
                                                    {{--                                                         aria-labelledby="pills-tab-4" tabindex="0">--}}
                                                    {{--                                                        <div class="shop-checkout-form cod">--}}
                                                    {{--                                                            <form action="#">--}}
                                                    {{--                                                                <div class="row">--}}
                                                    {{--                                                                    <div class="col-lg-12">--}}
                                                    {{--                                                                        <div class="form-check mb-20">--}}
                                                    {{--                                                                            <input class="form-check-input"--}}
                                                    {{--                                                                                   type="checkbox" value id="cod">--}}
                                                    {{--                                                                            <label class="form-check-label" for="cod">--}}
                                                    {{--                                                                                پرداخت نقدی هنگام تحویل--}}
                                                    {{--                                                                                <span>لطفاً <a href="#">شرایط و ضوابط</a> ما را برای دریافت نقدی هنگام تحویل بخوانید.</span>--}}
                                                    {{--                                                                            </label>--}}
                                                    {{--                                                                        </div>--}}
                                                    {{--                                                                    </div>--}}
                                                    {{--                                                                </div>--}}
                                                    {{--                                                            </form>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $total_price = 0 ;
                    @endphp
                    @foreach($cart as $item)
                        @php

                            $price = $item->product->product_price ;
                            $count = $item['count'] ;
                            $inventory = $item->product->inventory ;
                            $total_price += $price * $count ;
                        @endphp
                    @endforeach
                    <div class="col-lg-4">
                        <div class="shop-cart-summary">
                            <h5>خلاصه سبد خرید</h5>
                            <ul>
                                <li>
                                    <strong>قیمت کل :</strong>
                                    <span class="show_total_price_without_tax">
                                            {{number_format($total_price)}} ریال
                                        </span>
                                </li>
                                <li>
                                    <strong>تخفیف:</strong>
                                    <span>5.00 ریال</span>
                                </li>
                                {{--                                <li><strong>ارسال:</strong> <span>رایگان</span></li>--}}
                                <li>
                                    <strong>مالیات:</strong>
                                    <span class="show_tax_price">
                                            {{@number_format($total_price * 0.1)}} ریال
                                        </span>
                                </li>
                                <li class="shop-cart-total">
                                    <strong>مجموع:</strong>
                                    <span class="show_total_price_with_tax">
                                            {{@number_format(($total_price) + $total_price * 0.1)}} ریال
                                        </span>
                                </li>
                            </ul>
                            <form class="text-end mt-40" action="{{route('site.submitOrder')}}" method="post">
                                @csrf
                                <input type="hidden" value="1" name="gateway">
                                <button type="submit" onclick="submit_order()" class="theme-btn w-100 d-block">
                                    پرداخت
                                    <i class="fas fa-arrow-left-long"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
