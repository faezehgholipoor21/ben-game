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
            <div class="site-breadcrumb-bg" style="background: url({{asset('site/assets/img/breadcrumb/01.jpg')}})"></div>
            <div class="container">
                <div class="site-breadcrumb-wrap">
                    <h4 class="breadcrumb-title">وبلاگ تکی</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{route('site.home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li><a href="{{route('site.blog')}}"><i class=""></i>وبلاگ ها</a></li>
                        <li class="active">وبلاگ تکی</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="blog-single-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xxl-9 mx-auto">
                        <div class="blog-single-wrapper">
                            <div class="blog-single-content">
                                <div class="blog-thumb-img">
                                    <img src="{{asset('site/assets/img/blog/single.jpg')}}" alt="thumb">
                                </div>
                                <div class="blog-info">
                                    <div class="blog-meta">
                                        <div class="blog-meta-left">
                                            <ul>
                                                <li><i class="far fa-user"></i><a href="#">ژان آر گانتر</a></li>
                                                <li><i class="far fa-comments"></i>3.2هزار نظر</li>
                                                <li><i class="far fa-thumbs-up"></i>1.4هزار لایک</li>
                                            </ul>
                                        </div>
                                        <div class="blog-meta-right">
                                            <a href="#" class="share-btn"><i class="far fa-share-alt"></i>اشتراک گذاری</a>
                                        </div>
                                    </div>
                                    <div class="blog-details">
                                        <h3 class="blog-details-title mb-20">این یک واقعیت ثابت شده است که
                                            خواننده</h3>
                                        <p class="mb-10">
                                            اما باید برای شما توضیح دهم که چگونه این همه تصور اشتباه تقبیح لذت و
                                            ستایش درد متولد شد و من به شما گزارش کاملی از سیستم خواهم داد و
                                            آموزه های واقعی کاشف بزرگ حقیقت را توضیح دهید
                                            استاد ساز خوشبختی انسان هیچ کس لذت را رد نمی کند، دوست ندارد یا از آن اجتناب نمی کند
                                            خود، چون لذت است، اما به این دلیل که کسانی که نمی دانند چگونه به دنبال
                                            لذت به طور منطقی با عواقبی روبرو می شود که بسیار دردناک است.
                                        </p>
                                        <p class="mb-10">
                                            اما باید برای شما توضیح دهم که چگونه این همه تصور اشتباه تقبیح لذت و
                                            ستایش درد متولد شد و من به شما گزارش کاملی از سیستم خواهم داد و
                                            آموزه های واقعی کاشف بزرگ حقیقت را توضیح دهید
                                            استاد ساز خوشبختی انسان هیچ کس لذت را رد نمی کند، دوست ندارد یا از آن اجتناب نمی کند
                                            خود، چون لذت است، اما به این دلیل که کسانی که نمی دانند چگونه به دنبال
                                            لذت به طور منطقی با عواقبی روبرو می شود که بسیار دردناک است.
                                        </p>
                                        <blockquote class="blockqoute">
                                            این یک واقعیت ثابت شده است که خواننده از خواندنی ها حواسش پرت می شود
                                            محتوای یک صفحه هنگام مشاهده طرح بندی آن. نکته استفاده از لورم آپسیوم است
                                            که دارای توزیع کم و بیش نرمال است.
                                            <h6 class="blockqoute-author">مارک کرافورد</h6>
                                            <i class="far fa-quote-right"></i>
                                        </blockquote>
                                        <p class="mb-20">
                                            در ساعتی آزاد که قدرت انتخاب ما مهار نشده است و هیچ چیز
                                            مانع از آن می شود که بتوانیم کاری را که دوست داریم انجام دهیم، هر لذتی باید باشد
                                            استقبال شد و از هر دردی اجتناب شد. اما در شرایط خاص و با توجه به
                                            ادعای وظیفه یا تعهدات تجاری اغلب اتفاق می افتد که
                                            لذت ها را باید رد کرد و آزارها را پذیرفت. پس مرد عاقل
                                            همیشه در این موارد به این اصل انتخاب پایبند است.
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6 mb-20">
                                                <img src="{{asset('site/assets/img/blog/01.jpg')}}" alt>
                                            </div>
                                            <div class="col-md-6 mb-20">
                                                <img src="{{asset('site/assets/img/blog/02.jpg')}}" alt>
                                            </div>
                                        </div>
                                        <p class="mb-20">
                                            قدرت انتخاب بدون محدودیت است و زمانی که هیچ چیز مانع از توانایی ما نمی شود
                                            چیزی که ما بیشتر دوست داریم، از هر لذتی باید استقبال کرد و از هر دردی اجتناب کرد. ولی
                                            در شرایط خاص و به دلیل ادعای وظیفه یا تعهدات
                                            کسب و کار اغلب اتفاق می افتد که لذت ها باید رد شوند و
                                            مزاحمت پذیرفته شد بنابراین، انسان عاقل همیشه در این مسائل پایبند است
                                            این اصل انتخاب
                                        </p>
                                        <hr>
                                        <div class="blog-details-tags pb-20">
                                            <h5> برچسب‌ها: </h5>
                                            <ul>
                                                <li><a href="#">وبلاگ</a></li>
                                                <li><a href="#">آنلاین</a></li>
                                                <li><a href="#">لباس</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="blog-author">
                                        <div class="blog-author-img">
                                            <img src="{{asset('site/assets/img/blog/author.jpg')}}" alt>
                                        </div>
                                        <div class="author-info">
                                            <h6>نویسنده</h6>
                                            <h3 class="author-name">راجر دی دوک</h3>
                                            <p>این واقعیت ثابت شده است که خواننده با الفبا منحرف می شود
                                                محتوای قابل خواندن یک صفحه زمانی که این واقعیت ثابت شده است که یک خواننده به دنبال آن است
                                                در آن طرح بندی کمتر است.</p>
                                            <div class="author-social">
                                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                                <a href="#"><i class="fab fa-twitter"></i></a>
                                                <a href="#"><i class="fab fa-instagram"></i></a>
                                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                                                <a href="#"><i class="fab fa-youtube"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-comments mb-0">
                                    <h3>نظرات (20)</h3>
                                    <div class="blog-comments-wrapper">
                                        <div class="blog-comments-single">
                                            <img src="{{asset('site/assets/img/blog/com-1.jpg')}}" alt="thumb">
                                            <div class="blog-comments-content">
                                                <h5>جسی سینکلر</h5>
                                                <span><i class="far fa-clock"></i> 31 خرداد 1402</span>
                                                <p>تنوع‌های زیادی از قسمت‌ها وجود دارد که اکثریت در برخی از آنها دچار مشکل شده‌اند
                                                    طنز تزریق شده یا کلمات تصادفی که حتی طولانی به نظر نمی رسند
                                                    این واقعیت ثابت شده است که یک خواننده کمی قابل باور است.</p>
                                                <a href="#"><i class="far fa-reply"></i> پاسخ</a>
                                            </div>
                                        </div>
                                        <div class="blog-comments-single blog-comments-reply">
                                            <img src="{{asset('site/assets/img/blog/com-2.jpg')}}" alt="thumb">
                                            <div class="blog-comments-content">
                                                <h5>دانیل ولمن</h5>
                                                <span><i class="far fa-clock"></i> 31 خرداد 1402</span>
                                                <p>تنوع‌های زیادی از قسمت‌ها وجود دارد که اکثریت در برخی از آنها دچار مشکل شده‌اند
                                                    طنز تزریق شده یا کلمات تصادفی که حتی طولانی به نظر نمی رسند
                                                    این واقعیت ثابت شده است که یک خواننده کمی قابل باور است.</p>
                                                <a href="#"><i class="far fa-reply"></i> پاسخ</a>
                                            </div>
                                        </div>
                                        <div class="blog-comments-single">
                                            <img src="{{asset('site/assets/img/blog/com-3.jpg')}}" alt="thumb">
                                            <div class="blog-comments-content">
                                                <h5>کنت ایوانز</h5>
                                                <span><i class="far fa-clock"></i> 31 خرداد 1402</span>
                                                <p>تنوع‌های زیادی از قسمت‌ها وجود دارد که اکثریت در برخی از آنها دچار مشکل شده‌اند
                                                    طنز تزریق شده یا کلمات تصادفی که حتی طولانی به نظر نمی رسند
                                                    این واقعیت ثابت شده است که یک خواننده کمی قابل باور است.</p>
                                                <a href="#"><i class="far fa-reply"></i> پاسخ</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-comments-form">
                                        <h3>نظر بدهید</h3>
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="نام شما*">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" placeholder="ایمیل شما*">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                     <textarea class="form-control" rows="5"
                                                               placeholder="نظر شما*"></textarea>
                                                    </div>
                                                    <button type="submit" class="theme-btn">نظر ارسال کنید <i
                                                            class="far fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
            <div class="newsletter-img-1">
                <img src="{{asset('site/assets/img/newsletter/01.png')}}" alt>
            </div>
            <div class="newsletter-img-2">
                <img src="{{asset('site/assets/img/newsletter/02.png')}}" alt>
            </div>
        </div>

    </main>
@endsection
