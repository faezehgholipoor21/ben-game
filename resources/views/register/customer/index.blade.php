@extends('layouts.site_layout')
@section('title')
    سایت بازی | ثبت نام
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
                    <h4 class="breadcrumb-title">درباره ما</h4>
                    <ul class="breadcrumb-menu">
                        <li><a href="{{route('site.home')}}"><i class="far fa-home"></i> صفحه اصلی</a></li>
                        <li class="active">درباره ما</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="about-area py-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection
