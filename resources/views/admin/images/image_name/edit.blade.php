@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش عکس
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
                    <h1>ویرایش عکس</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.images_panel')}}">عکس ها</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش عکس
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.images_panel')}}" class="btn btn-sm btn-danger">
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
                            action="{{route('admin.images_update_panel', ['id' => $images_info['id']])}}"
                            method="post" class="row">
                            @csrf
                            <div class="col-12 col-sm-4 col-md-4">
                                <label>تصویر</label>
                                @error('image_name')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input data-default-file="{{asset($images_info['image_name'])}}"
                                       name="image_name"
                                       type="file" class="form-control dropify">
                            </div>
                            <div class="col-12 col-sm-4 col-md-5 mt-5">
                                <label>نوع عکس</label>
                                @error('image_type_id')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <div class="multiselect_div">
                                    <select id="image_type_id"
                                            class="form-control"
                                            name="image_type_id">
                                        @foreach($image_type_info as $item)
                                            <option value="{{$item['id']}}">
                                                {{$item['image_type_name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3 mt-5">
                                <button type="submit" class="btn btn-success w-100 mt-29">ویرایش عکس</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
