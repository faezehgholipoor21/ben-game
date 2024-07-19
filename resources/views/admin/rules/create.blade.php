@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن قانون جدید
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/summernote/dist/summernote.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}"/>
@endsection

@section('custom-js')
    <script src="{{asset('admin/assets/vendor/summernote/dist/summernote.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script>
        $(".dropify").dropify();

        $('#category_select').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: 200,
            selectAll: true,
            nonSelectedText: 'دسته بندی (ها) را انتخاب کنید',
            filterPlaceholder: 'جستجو کنید',
            allSelectedText: 'همه انتخاب شدند',
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن قانون جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.rule_panel')}}">قوانین</a></li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن قانون جدید</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.rule_panel')}}" class="btn btn-sm btn-danger">
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
                        <form enctype="multipart/form-data" action="{{route('admin.rule_store_panel')}}" method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label>عنوان عکس</label>
                                        @error('image_src')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input name="image_src" type="file" class="form-control dropify">
                                    </div>
                                    <div class="col-12 col-md-9 mt-4">
                                        <label>موضوع</label>
                                        @error('title')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 mt-2">
                                <label>پیشگفتار</label>
                                @error('topic')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <textarea name="topic"
                                          class="summernote">{{old('topic')}}</textarea>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 mt-2">
                                <label>قانون کامل</label>
                                @error('description')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <textarea name="description"
                                          class="summernote">{{old('description')}}</textarea>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-success w-25 mt-3">افزودن قانون</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
