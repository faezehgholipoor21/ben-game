@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش سطح جدید
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
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن سطح جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.membership')}}">باشگاه مشتریان</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش سطح</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.membership')}}" class="btn btn-sm btn-danger">
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
                        <form enctype="multipart/form-data" action="{{route('admin.membership_update' , ['member_id' => $member_info['id']])}}" method="post"
                              class="row">
                            @csrf
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>عنوان سطح</label>
                                        @error('name')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$member_info['name']}}" name="name" type="text" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>شناسه انگلیسی سطح (یکتا باشد)</label>
                                        @error('key')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$member_info['key']}}" dir="ltr" type="text" class="form-control"
                                               name="key">
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>درصد تخفیف</label>
                                        @error('discount')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$member_info['discount']}}" dir="ltr" type="text" class="form-control"
                                               name="discount">
                                    </div><div class="col-12 col-md-6 mb-4">
                                        <label>حداقل امتیاز ورود به سطح ( یکتا باشد )</label>
                                        @error('require_point')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$member_info['require_point']}}" dir="ltr" type="text" class="form-control"
                                               name="require_point">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mb-6">
                                        <label>توضیحات سطح باشگاه</label>
                                        @error('description')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="description"
                                                  class="summernote">{{$member_info['description']}}</textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 mt-3">
                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-plus mr-2"></i>
                                            افزودن سطح
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

