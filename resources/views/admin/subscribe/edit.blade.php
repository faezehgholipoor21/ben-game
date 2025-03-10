@extends('layouts.admin_layout')

@section('Title')پنل مدیریت | ویرایش اشتراک جدید@endsection

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
                    <h1>ویرایش اشتراک جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.subscribe')}}">ویرایش ها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش اشتراک جدید</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.subscribe')}}" class="btn btn-sm btn-danger">
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
                        <form enctype="multipart/form-data" action="{{route('admin.subscribe_update',['sub_id' => $subscriber['id']])}}" method="post" class="row">
                            @csrf
                            <div class="col-12 col-sm-5 col-md-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label>تصویر اشتراک</label>
                                        @error('image')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input name="image" type="file" class="form-control dropify"
                                               data-default-file="{{asset($subscriber['image'])}}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-7 col-md-9">
                                <div class="row">
                                    <div class="col-12 col-md-8 mb-4">
                                        <label>عنوان اشتراک</label>
                                        @error('name')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$subscriber['name']}}" name="name" type="text" class="form-control">
                                    </div>

                                    <div class="col-12 col-md-4 mb-4">
                                        <label>قیمت ( دلار )</label>
                                        @error('price')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$subscriber['price']}}" dir="ltr" type="text" class="form-control" name="price">
                                    </div>

                                    <div class="col-12 col-md-6 mb-4">
                                        <label>تعداد روز اشتراک</label>
                                        @error('date')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$subscriber['date']}}" dir="ltr" type="text" class="form-control" name="date">
                                    </div>

                                    <div class="col-12 col-md-6 mb-4">
                                        <label>درصد تخفیف</label>
                                        @error('discount')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$subscriber['discount']}}" dir="ltr" type="text" class="form-control" name="discount">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-6">
                                        <label>توضیحات اشتراک</label>
                                        @error('description')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="description" class="summernote">{{$subscriber['description']}}</textarea>
                                    </div>
                                </div>


                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-plus mr-2"></i>
                                            ویرایش اشتراک
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

