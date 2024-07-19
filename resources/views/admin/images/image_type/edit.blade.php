@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش نوع عکس ها
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>ویرایش نوع عکس</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.image_type_panel')}}">نوع عکس ها</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش نوع عکس
                                ({{$image_type_info['image_type_name']}})
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.image_type_panel')}}" class="btn btn-sm btn-danger">
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
                            action="{{route('admin.image_type_update_panel', ['id' => $image_type_info['id']])}}"
                            method="post" class="row">
                            @csrf
                            <div class="col-12 col-sm-4 col-md-3">
                                <label>نام نوع جدید عکس</label>
                                @error('image_type_name')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="image_type_name"
                                       value="{{$image_type_info['image_type_name']}}">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <label>نامک نوع جدید عکس</label>
                                @error('image_type_slug')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="image_type_slug"
                                       value="{{$image_type_info['image_type_slug']}}">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button type="submit" class="btn btn-success w-100 mt-29">ویرایش نوع عکس</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
