@extends('layouts.user_layout')

@section('title')
    اکانت های من
@endsection

@section('custom-css')
    <style>
        .my_i{
            margin-left: 5px !important;
        }
    </style>
@endsection


@section('custom-js')
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="user-card">
                <div class="user-card-header">
                    <h4 class="user-card-title">اکانت های من</h4>
                    <div class="user-card-header-right">
                        <a href="{{route('user.account_create')}}" class="theme-btn">
                            <i class="fa fa-plus my_i"></i>
                            تعریف اکانت جدید
                        </a>
                    </div>
                </div>
                @if(!empty($accounts->all()))

                @else
                    <p class="alert alert-warning">
                        اکانتی تعریف نشده است
                    </p>
                @endif

            </div>
        </div>
    </div>
@endsection



