@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش تنظیمات تماس ما
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
                            <li class="breadcrumb-item"><a href="{{route('admin.setting_contact_panel')}}">تنظیمات تماس با ما</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش تماس با ما</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-sm btn-danger">
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
                              action="{{route('admin.setting_contact_update_panel')}}" method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-12 col-md-7 mb-4">
                                        <label>آدرس</label>
                                        @error('address')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$setting_contact_info['address']}}" name="address" type="text"
                                               class="form-control">
                                    </div>
                                    <div class="col-12 col-md-5 mb-4">
                                        <label>زمان باز</label>
                                        @error('open_store')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$setting_contact_info['open_store']}}" name="open_store" type="text"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>موبایل یک</label>
                                        @error('mobile')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$setting_contact_info['mobile']}}" name="mobile" type="number"
                                               class="form-control">
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>موبایل دو</label>
                                        @error('phone')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$setting_contact_info['phone']}}" name="phone" type="number"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>ایمیل یک</label>
                                        @error('email_one')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$setting_contact_info['email_one']}}" name="email_one" type="email"
                                               class="form-control">
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>ایمیل دو</label>
                                        @error('email_two')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$setting_contact_info['email_two']}}" name="email_two" type="email"
                                               class="form-control">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-3">
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
