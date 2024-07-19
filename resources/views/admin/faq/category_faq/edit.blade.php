@extends('layouts.admin_layout')

@section('Title') پنل مدیریت | ویرایش@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>ویرایش</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.faq_category_panel')}}">دسته بندی سوالات متدوال</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش
                                ({{$faq_category['faq_title']}})
                            </li>
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
                        <form
                            action="{{route('admin.faq_category_update_panel', ['id' => $faq_category['id']])}}"
                            method="post" class="row">
                            @csrf
                            <div class="col-12 col-sm-6 col-md-3">
                                <label>عنوان دسته بندی</label>
                                @error('faq_title')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="faq_title"
                                       value="{{$faq_category['faq_title']}}">
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <button type="submit" class="btn btn-success w-100 mt-29">ویرایش دسته بندی سوالات متدوال</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
