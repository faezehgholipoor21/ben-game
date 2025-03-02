@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن فیلد جدید اکانت
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن اکانت جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">
                                    پنل مدیریت
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.game_account_field')}}">فیلدها</a></li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن فیلد جدید اکانت</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.game_account_field')}}" class="btn btn-sm btn-danger">
                        <i class="fa fa-angle-right mr-2"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <form
                        action="{{route('admin.game_account_field_store')}}"
                        method="post" class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label>عنوان فیلد (فارسی)</label>
                                @error('label')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input type="text" class="form-control" name="label" placeholder="یک نام فارسی برای عنوان فیلد بنویسید">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>نوع فیلد (لاتین)</label>
                                @error('type')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input  type="text" dir="ltr"  class="form-control" name="type" placeholder="email یا password  یا text">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>نام فیلد (لاتین)</label>
                                @error('field_name')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input  type="text" dir="ltr" class="form-control" name="field_name" placeholder="یک نام غیر تکراری انتخاب کنید">
                            </div>
                        </div>

                        <hr class="horizontal_row my-4">

                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save mr-2"></i>
                                ثبت فیلد اکانت
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

