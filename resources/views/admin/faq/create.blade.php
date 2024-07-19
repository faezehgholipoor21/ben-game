@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن سوال
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
                    <h1>افزودن سوال</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.faq_panel')}}">سوالات متدوال</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن سوال جدید</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.faq_panel')}}" class="btn btn-sm btn-danger">
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
                        <form enctype="multipart/form-data" action="{{route('admin.faq_store_panel')}}" method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-sm-7 col-md-12">
                                <div class="row">
                                    <div class="col-12 col-md-12 mb-3">
                                        <label>سوال</label>
                                        @error('question')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{old('question')}}" name="question" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 mb-3">
                                        <label>پاسخ</label>
                                        @error('answer')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="answer"
                                                  class="summernote">{{old('answer')}}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label>دسته بندی سوالات</label>
                                        @error('cat_id')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <div class="multiselect_div">
                                            <select id="cat_id"
                                                    class=" form-control"
                                                    name="cat_id">
                                                @foreach($faq_category_info as $faq_category)
                                                    <option value="{{$faq_category['id']}}">
                                                        {{$faq_category['faq_title']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-plus mr-2"></i>
                                            افزودن محصول
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
