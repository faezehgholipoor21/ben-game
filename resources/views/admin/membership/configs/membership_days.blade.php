@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش روز باشگاه
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
                    <h1>ویرایش روز باشگاه </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش تعداد روز باشگاه</li>
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
                        <form enctype="multipart/form-data"
                              action="{{route('admin.membership_day_update')}}" method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-md-9 mb-4">
                                <label>تعداد روز باشگاه</label>
                                @error('limit_day_membership')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input dir="ltr" value="{{$limit_day_membership}}" name="limit_day_membership" type="text"
                                       class="form-control">
                            </div>

                            <div class="col-12 col-md-3 mt-4">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fa fa-edit mr-2"></i>
                                    ویرایش روز باشگاه
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

