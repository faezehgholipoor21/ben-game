@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن دسته بندی جدید سوالات متدوال
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن دسته بندی جدید سوالات متدوال</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.faq_category_panel')}}">دسته بندی سوالات متدوال</a></li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن دسته بندی سوالات متدوال</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.faq_category_panel')}}" class="btn btn-sm btn-danger">
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
                        <form action="{{route('admin.faq_category_store_panel')}}" method="get" class="row">
                            @csrf
                            <div class="col-12 col-sm-6 col-md-6">
                                <label>عنوان دسته بندی سوالات متدوال</label>
                                @error('faq_title')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="faq_title" value="{{old('faq_title')}}">
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <button class="btn btn-success w-100 mt-29">افزودن دسته بندی</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
