@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن محصول جدید
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
                    <h1>افزودن محصول جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.product_panel')}}">محصولات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن محصول جدید</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.product_panel')}}" class="btn btn-sm btn-danger">
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
                              action="{{route('admin.contact_delete_panel', ['id' => $contact_show_info['id']])}}"
                              method="post" class="row">
                            @csrf
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>نام کاربر</label>
                                        <p class="mb-0 form-control">
                                            {{$contact_show_info['contact_name']}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>موبایل کاربر</label>
                                        <p class="mb-0 form-control">
                                            {{$contact_show_info['contact_mobile']}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 mb-4">
                                        <label>موضوع</label>
                                        <p class="mb-0 form-control">
                                            {{$contact_show_info['contact_subject']}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 mb-4">
                                        <label>متن پیام</label>
                                        <p class="mb-0 summernote">
                                            {{$contact_show_info['contact_content']}}
                                        </p>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-danger w-100">
                                            <i class="fa fa-minus mr-2"></i>
                                            حذف سوال
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
