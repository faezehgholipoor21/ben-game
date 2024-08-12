@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش قوانین
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
                    <h1>ویرایش قوانین</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.rule_panel')}}">قوانین</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش قانون</li>
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
                        <form enctype="multipart/form-data"
                              action="{{route('admin.rule_update_panel', ['id'=>$rule_info['id']])}}"
                              method="post"
                              class="row">
                            @csrf
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label>تصویر قانون</label>
                                        @error('image_src')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input data-default-file="{{asset($rule_info['image_src'])}}"
                                               name="image_src" type="file" class="form-control dropify">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label>موضوع</label>
                                        @error('title')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$rule_info['title']}}" name="title"
                                               type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                                <div class="col-12 col-sm-12 col-md-12 mt-4">
                                <div class="row">
                                    <div class="col-12 col-md-12 mb-4">
                                        <label>پیشگفتار</label>
                                        @error('topic')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="topic"
                                                  class="summernote">{{$rule_info['topic']}}</textarea>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 mt-2">
                                        <div class="row">
                                    <div class="col-12 col-md-12">
                                        <label>قانون کامل</label>
                                        @error('description')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="description"
                                                  class="summernote">{{$rule_info['description']}}</textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-end mt-2">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-edit mr-2"></i>
                                            ویرایش قانون
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
