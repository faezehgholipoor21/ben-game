@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش مالیات
@endsection

@section('custom-css')
@endsection

@section('custom-js')
    <script>

    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>ویرایش مالیات </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش مالیات</li>
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
                              action="{{route('admin.tax_update')}}" method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-md-9 mb-4">
                                <label>درصد مالیات</label>
                                @error('tax')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input dir="ltr" value="{{$config_tax['value']}}" name="tax" type="text"
                                       class="form-control">
                            </div>

                            <div class="col-12 col-md-3 mt-4">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fa fa-edit mr-2"></i>
                                    ویرایش مالیات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

