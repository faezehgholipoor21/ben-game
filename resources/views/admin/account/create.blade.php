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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.game_account_panel')}}">اکانت ها</a></li>
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
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.game_account_store_panel')}}" method="get" class="row">
                            @csrf
                            <div class="col-12 col-sm-6 col-md-3">
                                <label>عنوان اکانت</label>
                                @error('account_name')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="account_name" value="{{old('account_name')}}">
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <button class="btn btn-success w-100 mt-29">افزودن اکانت</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
