@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن عکس جدید
@endsection
@section('custom-js')
    <script>
        $(".dropify").dropify();
    </script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن عکس جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.images_panel')}}">عکس ها</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن عکس جدید</li>
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
                        <form action="{{route('admin.images_store_panel')}}" method="post" class="row" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12">
                                    <label>تصویر</label>
                                    @error('image_name')
                                    <span class="validation_label_error">{{$message}}</span>
                                    @enderror
                                    <input name="image_name" type="file" class="form-control dropify">
                            </div>
                            <div class="col-12 mt-4">
                                <label>نوع عکس</label>
                                @error('image_type_id')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <div class="multiselect_div">
                                    <select id="image_type_id"
                                            class="form-control"
                                            name="image_type_id">
                                        @foreach($image_type_info as $image_type)
                                            <option value="{{$image_type['id']}}">
                                                {{$image_type['image_type_name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button class="btn btn-success w-25 mt-29">افزودن عکس</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
