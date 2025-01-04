@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن اکانت جدید
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن اکانت جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">
                                    پنل مدیریت
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.game_account_panel')}}">اکانت ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن اکانت جدید</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.game_account_panel')}}" class="btn btn-sm btn-danger">
                        <i class="fa fa-angle-right mr-2"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <form action="{{route('admin.game_account_store_panel')}}" method="get" class="row">--}}
{{--                            @csrf--}}
{{--                            <div class="col-12">--}}
{{--                                <label>عنوان اکانت</label>--}}
{{--                                @error('account_name')--}}
{{--                                <span class="validation_label_error">{{$message}}</span>--}}
{{--                                @enderror--}}
{{--                                <input required type="text" class="form-control" name="account_name" value="{{old('account_name')}}">--}}
{{--                            </div>--}}
{{--                            <div class="col-12 col-sm-6 col-md-3">--}}
{{--                                <button class="btn btn-success w-100 mt-29">افزودن اکانت</button>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="card">
                    <form
                        action="{{route('admin.game_account_store_panel')}}"
                        method="post" class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label>عنوان اکانت</label>
                                @error('account_name')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="account_name">
                            </div>
                        </div>

                        <hr class="horizontal_row my-4">

                        <div class="row mb-3">
                            <div class="col-12">
                                <label>لطفا فیلدهای اکانت را انتخاب کنید</label>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($fields as $key => $field)
                                <div class="col-12 col-md-6 col-lg-3 col-xl-2 mb-4">
                                    <div class="custom-control custom-switch">
                                        <input value="{{$field['id']}}" name="fields[]" type="checkbox" class="custom-control-input" id="customSwitch_{{$key}}">
                                        <label class="custom-control-label" for="customSwitch_{{$key}}">
                                            {{$field['label']}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="horizontal_row mb-5">

                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-edit mr-2"></i>
                                ویرایش اکانت
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
