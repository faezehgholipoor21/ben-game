@extends('layouts.site_layout')
@section('title')
    سایت بازی
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
    <main class="main">

        <div class="site-breadcrumb">
            <div class="site-breadcrumb-bg"
                 style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">
                        خدمات پرداخت ارزی
                    </h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{route('site.home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">
                            خدمات پرداخت ارزی آنلاین
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="user-area bg py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar">
                            <div class="sidebar-top">
                                <div class="sidebar-profile-img">
                                    <img src="{{asset('site/assets/img/account/user.jpg')}}" alt>
                                    <button type="button" class="profile-img-btn"><i class="far fa-camera"></i></button>
                                    <input type="file" class="profile-img-file">
                                </div>
                                <h5>آنتونی جانسون</h5>
                                <p><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                      data-cfemail="6f0e011b0001062f0a170e021f030a410c0002">ad@info.com</a></p>
                            </div>
                            <ul class="sidebar-list">
                                <li><a href="vendor-dashboard.html"><i class="far fa-gauge-high"></i> داشبورد</a></li>
                                <li><a href="vendor-profile.html"><i class="far fa-user"></i> نمایه من</a></li>
                                <li><a href="vendor-product.html"><i class="far fa-layer-group"></i> محصولات</a></li>
                                <li><a class="active" href="vendor-add-product.html"><i class="far fa-upload"></i>
                                        افزودن جدید
                                        محصول</a></li>
                                <li><a href="vendor-order.html"><i class="far fa-shopping-bag"></i> همه سفارش‌ها <span
                                            class="badge badge-danger">02</span></a></li>
                                <li><a href="vendor-payout.html"><i class="far fa-wallet"></i> پرداخت</a></li>
                                <li><a href="vendor-transaction.html"><i class="far fa-credit-card"></i> تراکنش</a>
                                </li>
                                <li><a href="vendor-notification.html"><i class="far fa-bell"></i> اعلان <span
                                            class="badge badge-danger">02</span></a></li>
                                <li><a href="vendor-message.html"><i class="far fa-envelope"></i> پیام‌ها <span
                                            class="badge badge-danger">02</span></a></li>
                                <li><a href="vendor-setting.html"><i class="far fa-gear"></i> تنظیمات</a></li>
                                <li><a href="#"><i class="far fa-sign-out"></i> خروج</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="user-wrapper">
                            <div class="user-card">
                                <div class="user-card-header">
                                    <h4 class="user-card-title">خدمات پرداخت ارزی آنلاین</h4>
                                    <h4 class="user-card-title">پشتیبانی : 02191300033</h4>
                                </div>
                                <div class="col-lg-12">
                                    <div class="user-form">
                                        <h6 class="mb-20">اطلاعات پایه</h6>
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>نوع پرداخت</label>
                                                        <div class="theme-btn">
                                                            دلار
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>قیمت پایه</label>
                                                        <input type="text" class="form-control" placeholder="67.600 تومان">
                                                        <div class="form-text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label>مقدار پرداختی</label>
                                                        <input type="text" class="form-control" placeholder="مقدار دلار پرداختی را وارد کنید">
                                                        <div class="form-text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>روش پرداخت</label>
                                                        <select class="select">
                                                            <option value>دسته را انتخاب کنید</option>
                                                            <option value="1">ویزا کارت</option>
                                                            <option value="2">الکترونیک</option>
                                                            <option value="3">خواربارفروشی و بازار</option>
                                                            <option value="4">خانه و مبلمان</option>
                                                            <option value="5">اسباب بازی و بازی های ویدیویی</option>
                                                            <option value="6">هدایا</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>نوع بازی ( برنامه یا سایت )</label>
                                                        <input type="text" class="form-control" placeholder="نام بازی ، برنامه یا سایت را وارد کنید">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>ایمیل یا شماره حساب</label>
                                                        <input type="text" class="form-control" placeholder="ایمیل حساب خود را وارد کنید">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>نوع اکانت</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="نوع اکانت خود را وارد کنید">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label> سهام</label>
                                                        <input type="text" class="form-control" placeholder="سهام">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>واحد سهام</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="واحد سهام">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>رنگ</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="رنگ مثال: قرمز, مشکی">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>اندازه</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="اندازه مثال: SM, XL">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>برچسب ها یا کلمات کلیدی</label>
                                                        <input type="text" class="form-control"
                                                               placeholder="برچسب ها: ساعت، مشکی، مدرن">
                                                    </div>
                                                </div>
                                                <h6 class="mt-20 mb-20">آپلود تصاویر</h6>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="form-upload-wrapper">
                                                            <div class="form-img-upload">
                                                             <span><i
                                                                     class="far fa-images"></i> آپلود تصاویر محصول</span>
                                                            </div>
                                                            <input type="file" class="form-img-file" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h6 class="mt-20 mb-20">اطلاعات تفصیلی</h6>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>توضیح</label>
                                                        <textarea class="form-control" placeholder="نوشتن توضیحات"
                                                                  cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>اطلاعات اضافی</label>
                                                        <textarea class="form-control" placeholder="اطلاعات اضافی"
                                                                  cols="30" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <h6 class="mt-20 mb-20">ویژگی ها</h6>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature1">
                                                        <label class="form-check-label" for="feature1">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature2">
                                                        <label class="form-check-label" for="feature2">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature3">
                                                        <label class="form-check-label" for="feature3">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature4">
                                                        <label class="form-check-label" for="feature4">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature5">
                                                        <label class="form-check-label" for="feature5">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature6">
                                                        <label class="form-check-label" for="feature6">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature7">
                                                        <label class="form-check-label" for="feature7">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature8">
                                                        <label class="form-check-label" for="feature8">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="feature" type="checkbox" .
                                                               id="feature9">
                                                        <label class="form-check-label" for="feature9">
                                                            مشخصات محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <h6 class="mt-20 mb-20">وضعیت</h6>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="status" type="radio" value
                                                               id="status1">
                                                        <label class="form-check-label" for="status1">
                                                            انتشار محصول
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="status" type="radio" .
                                                               id="status2">
                                                        <label class="form-check-label" for="status2">
                                                            ذخیره پیش نویس (در انتظار)
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="status" type="radio" .
                                                               id="status3">
                                                        <label class="form-check-label" for="status3">
                                                            محصول پنهان
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-4">
                                                    <div class="form-check border-top pt-4">
                                                        <input class="form-check-input" name="agree" type="checkbox" .
                                                               id="agree">
                                                        <label class="form-check-label" for="agree">
                                                            من با شما موافقم <a href="#">شرایط خدمات</a> و <a
                                                                href="#">خط مشی رازداری</a>.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="theme-btn"><span class="far fa-save"></span>
                                                ارسال
                                                محصول شما
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
