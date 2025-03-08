@extends('layouts.user_layout')

@section('title')
    سایت بنیامین | اشتراکها
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('admin/assets/css/persianDatePicker.css')}}">
@endsection

@section('custom-js')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>خرید اشتراک</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('user.dashboard')}}">
                                    پنل مشتری
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">خرید اشتراک</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <p class="alert alert-info">توضیحات اشتراک</p>
            </div>
            <div class="col-12">
                <div class="row">
                    @foreach($subscribe_list as $subscribe)
                            <div class="col-12 col-md-3">
                                <h5>
                                    {{$subscribe['name']}}
                                </h5>
                                <a href="{{route('user.subscribe_pay' , ['sub_id' => $subscribe['id']])}}">
                                    خرید اشتراک
                                </a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection

