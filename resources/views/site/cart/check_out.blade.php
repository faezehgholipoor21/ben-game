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

@endsection
