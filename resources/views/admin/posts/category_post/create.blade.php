@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن دسته بندی جدید مقالات
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن دسته بندی جدید مقالات</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.category_post.index')}}">دسته بندی مقالات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن دسته بندی سوالات متدوال</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.category_post.index')}}" class="btn btn-sm btn-danger">
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
                        <form action="{{route('admin.category_post.store')}}" method="post" class="row">
                            @csrf
                            <div class="col-12 col-sm-6 col-md-6">
                                <label>عنوان دسته بندی مقالات</label>
                                @error('cat_post_title')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="cat_post_title" value="{{old('cat_post_title')}}">
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