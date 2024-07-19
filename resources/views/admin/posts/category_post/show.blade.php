@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش دسته بندی مقالات
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>ویرایش دسته بندی مقالات</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.category_post.index')}}">دسته بندی مقالات</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش دسته بندی مقالات
                                ({{$category_post_info['cat_post_title']}})
                            </li>
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
                        <form
                            action="{{route('admin.category_post.update', ['category_post' => $category_post_info['id']])}}"
                            method="post" class="row">
                            @csrf
                            @method('PUT')
                            <div class="col-12 col-sm-6 col-md-3">
                                <label>عنوان دسته بندی</label>
                                @error('cat_post_title')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="cat_post_title"
                                       value="{{$category_post_info['cat_post_title']}}">
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <button type="submit" class="btn btn-success w-100 mt-29">ویرایش دسته بندی مقالات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
