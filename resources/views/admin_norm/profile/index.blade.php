@extends('layouts.admin_norm_layout')

@section('title')
    سایت بازی | نمایه من
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
    </script>
@endsection

@section('content')
    <div class="user-card">
        <h4 class="user-card-title">اطلاعات شخصی</h4>
        <form action="{{route('admin_norm.update' , ['user_id' => $admin_norm_info['id']])}}" method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label>تصویر کارشناس</label>
                            @error('user_image')
                            <span class="validation_label_error">{{$message}}</span>
                            @enderror
                            <input name="user_image" type="file" class="form-control dropify"
                                   data-default-file="{{asset($admin_norm_info['user_image'])}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label>نام</label>
                            @error('first_name')
                            <span class="validation_label_error">{{$message}}</span>
                            @enderror
                            <input name="first_name" type="text" class="form-control"
                                   value="{{$admin_norm_info['first_name']}}" disabled>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label>نام خانوادگی</label>
                            @error('last_name')
                            <span class="validation_label_error">{{$message}}</span>
                            @enderror
                            <input name="last_name" type="text" class="form-control"
                                   value="{{$admin_norm_info['last_name']}}" disabled>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label>کد ملی</label>
                            @error('national_code')
                            <span class="validation_label_error">{{$message}}</span>
                            @enderror
                            <input name="national_code" type="text" class="form-control" dir="ltr"
                                   value="{{$admin_norm_info['national_code']}}" disabled>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label>تلفن همراه</label>
                            @error('mobile')
                            <span class="validation_label_error">{{$message}}</span>
                            @enderror
                            <input name="mobile" type="text" class="form-control" dir="ltr"
                                   value="{{$admin_norm_info['mobile']}}">
                        </div>
                        <div class="col-12 text-right">
                            <button class="theme-btn">
                                <i class="fa fa-save ml-3"></i>
                                ویرایش اطلاعات

                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
