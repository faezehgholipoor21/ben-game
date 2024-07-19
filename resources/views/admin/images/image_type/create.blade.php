@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن نوع عکس جدید
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن نوع عکس جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.image_type_panel')}}">نوع عکس ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن نوع عکس جدید</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.image_type_panel')}}" class="btn btn-sm btn-danger">
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
                        <form action="{{route('admin.image_type_store_panel')}}" method="get" class="row">
                            @csrf
                            <div class="col-12 col-sm-4 col-md-3">
                                <label>عنوان نوع عکس</label>
                                @error('image_type_name')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="image_type_name" value="{{old('image_type_name')}}">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <label>عنوان نامک عکس</label>
                                @error('image_type_slug')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="image_type_slug" value="{{old('image_type_slug')}}">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button class="btn btn-success w-100 mt-29">افزودن نوع عکس</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
