@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش درباره ما
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
                    <h1>ویرایش دربازه ما </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.posts.index')}}">درباره ما</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش درباره ما</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.posts.index')}}" class="btn btn-sm btn-danger">
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
                        <form enctype="multipart/form-data"
                              action="{{route('admin.about_us_update_panel')}}" method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-sm-5 col-md-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label>تصویر درباره ما</label>
                                        @error('image')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input data-default-file="{{asset($about_info['image'])}}" name="image"
                                               type="file" class="form-control dropify">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-7 col-md-9">
                                <div class="row">
                                    <div class="col-12 col-md-8 mb-4">
                                        <label>عنوان درباره ما</label>
                                        @error('title')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$about_info['title']}}" name="title" type="text"
                                               class="form-control">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label>محتوای درباره ما</label>
                                        @error('description')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="description"
                                                  class="summernote">{{$about_info['description']}}</textarea>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fa fa-edit mr-2"></i>
                                            ویرایش درباره ما
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
