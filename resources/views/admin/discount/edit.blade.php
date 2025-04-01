@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش تخفیف
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/assets/css/persianDatePicker.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/select2.css')}}">

@endsection

@section('custom-js')
    <script src="{{asset('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js')}}"></script>
    <script src="{{asset('admin/assets/js/persian-date.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/persian-datepicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/select2.js')}}"></script>
    <script>

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "محصولات مورد نظر را انتخاب کنید",
                allowClear: true,
                dir: "rtl"

            });

            $('.datePicker').persianDatepicker({
                format: "YYYY/MM/DD",
                viewMode: 'year',
            });

            let oldDate = "{{ $jalali_date }}"; // مقدار دریافت‌شده از کنترلر
            $("#datePicker").val(oldDate);
        });
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن تخفیف جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.discount')}}">تخفیف</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش تخفیف</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.discount')}}" class="btn btn-sm btn-danger">
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
                        <form enctype="multipart/form-data" action="{{route('admin.discount_update' , ['discount_id' => $discount['id']])}}" method="post" class="row">
                            @csrf
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>عنوان تخفیف</label>
                                        @error('discount_name')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$discount['discount_name']}}" name="discount_name" type="text" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>کد تخفیف (لاتین)</label>
                                        @error('discount_code')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$discount['discount_code']}}" dir="ltr" type="text" class="form-control" name="discount_code">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-3 mb-4">
                                        <label>تاریخ جدید</label>
                                        @error('expired_time')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input readonly type="text" class="form-control datePicker whiteReadOnly"
                                               name="expired_time" value="{{ $jalali_date }}">
                                    </div>
                                    <div class="col-12 col-md-3 mb-4">
                                        <label>تاریخ فعلی</label>
                                        @error('expired_time')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input readonly type="text" class="form-control" disabled="disabled"
                                               name="expired_time_old" value="{{ $jalali_date }}">
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>محدودیت</label>
                                        @error('limit')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$discount['limit']}}" dir="ltr" type="text" class="form-control" name="limit">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label for="cat">انتخاب دسته مورد نظر (در صورت عدم انتخاب روی تمام محصولات اعمال میشود):</label>
                                        <select name="cat" id="cat" class="form-control">
                                            @if($discount['cat_id'] == 0)
                                                <option value="0">تخفیف عمومی برای همه ی محصولات</option>
                                            @else
                                                @foreach ($categories as $cat)
                                                    <option @if($cat['id'] == $discount['cat_id']) selected="selected" @endif value="{{ $cat->id }}">{{ $cat->cat_title }} </option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <label>درصد تخفیف (چند درصد تخفیف)</label>
                                        @error('percentage')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$discount['percentage']}}" dir="ltr" type="text" class="form-control" name="percentage">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-plus mr-2"></i>
                                            افزودن تخفیف
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
