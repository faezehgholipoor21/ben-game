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
                    <h4 class="breadcrumb-title">نوار جانبی شبکه وبلاگ</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{route('site.home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">نوار کناری شبکه وبلاگ</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="blog-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="row">
                           @foreach($posts as $post)
                                <div class="col-md-6">
                                    <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                        <div class="blog-item-img">
                                            <img src="{{asset($post['post_image'])}}" alt="Thumb">
                                        </div>
                                        <div class="blog-item-info">
{{--                                            <div class="blog-item-meta">--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="#"><i class="far fa-user-circle"></i> توسط آلیشیا دیویس</a></li>--}}
{{--                                                    <li><a href="#"><i class="far fa-calendar-alt"></i> 29 بهمن 1402</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
                                            <h4 class="blog-title">
                                                <a href="#">{{$post['post_title']}}</a>
                                            </h4>
                                            <p>{{$post['post_meta_description0']}}</p>
                                            <a class="theme-btn" href="#">بیشتر بخوانید<i class="fas fa-arrow-left-long"></i></a>
                                        </div>
                                    </div>
                                </div>
                           @endforeach
                        </div>

                        <div class="pagination-area mb-lg-0">
                            <div aria-label="نمونه پیمایش صفحه">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item">
                                        <a class="page-link ms-0" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><i class="far fa-arrow-right"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><span class="page-link">...</span></li>
                                    <li class="page-item"><a class="page-link" href="#">10</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true"><i class="far fa-arrow-left"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 col-12">
                        <aside class="sidebar">

                            <div class="widget search">
                                <h5 class="widget-title">جستجو</h5>
                                <form class="search-form">
                                    <input type="text" class="form-control" placeholder="در اینجا جستجو کنید...">
                                    <button type="submit"><i class="far fa-search"></i></button>
                                </form>
                            </div>

                            <div class="widget category">
                                <h5 class="widget-title">دسته</h5>
                                <div class="category-list">
                                    <a href="#"><i class="far fa-arrow-left"></i>الکترونیک<span>(10)</span></a>
                                    <a href="#"><i class="far fa-arrow-left"></i>خرید آنلاین<span>(15)</span></a>
                                    <a href="#"><i class="far fa-arrow-left"></i>لوازم جانبی
                                        مجموعه<span>(20)</span></a>
                                    <a href="#"><i class="far fa-arrow-left"></i>مجموعه دوچرخه<span>(30)</span></a>
                                    <a href="#"><i class="far fa-arrow-left"></i>لباس مردانه<span>(25)</span></a>
                                    <a href="#"><i class="far fa-arrow-left"></i>مواد غذایی<span>(25)</span></a>
                                </div>
                            </div>

                            <div class="widget recent-post">
                                <h5 class="widget-title">پست اخیر</h5>
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        <img src="{{asset('site/assets/img/blog/bs-1.jpg')}}" alt="thumb">
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6><a href="#">چگونه هر روز از چیزهای مورد علاقه خود لذت ببرید</a></h6>
                                        <span><i class="far fa-clock"></i>31 خرداد 1402</span>
                                    </div>
                                </div>
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        <img src="{{asset('site/assets/img/blog/bs-2.jpg')}}" alt="thumb">
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6><a href="#">چگونه هر روز از چیزهای مورد علاقه خود لذت ببرید</a></h6>
                                        <span><i class="far fa-clock"></i>31 خرداد 1402</span>
                                    </div>
                                </div>
                                <div class="recent-post-single">
                                    <div class="recent-post-img">
                                        <img src="{{asset('site/assets/img/blog/bs-3.jpg')}}" alt="thumb">
                                    </div>
                                    <div class="recent-post-bio">
                                        <h6><a href="#">چگونه هر روز از چیزهای مورد علاقه خود لذت ببرید</a></h6>
                                        <span><i class="far fa-clock"></i>31 خرداد 1402</span>
                                    </div>
                                </div>
                            </div>

                            <div class="widget social-share">
                                <h5 class="widget-title">ما را دنبال کنید</h5>
                                <div class="social-share-link">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-dribbble"></i></a>
                                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>

                            <div class="widget sidebar-tag">
                                <h5 class="widget-title">برچسب های محبوب</h5>
                                <div class="tag-list">
                                    <a href="#">وبلاگ</a>
                                    <a href="#">معامله</a>
                                    <a href="#">آنلاین</a>
                                    <a href="#">خرید</a>
                                    <a href="#">الکترونیک</a>
                                    <a href="#">پیشنهاد</a>
                                    <a href="#">نکات</a>
                                    <a href="#">تلفن</a>
                                    <a href="#">تماشا کنید</a>
                                </div>
                            </div>
                        </aside>
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
