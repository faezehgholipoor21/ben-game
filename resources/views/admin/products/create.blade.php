@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | افزودن محصول جدید
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

        $(document).ready(function() {
            $('#game_account_ids').multiselect({
                includeSelectAllOption: true,
                nonSelectedText: 'انتخاب اکانت',
                buttonWidth: '100%',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'جستجو کنید',
                allSelectedText: 'همه انتخاب شدند',
                numberDisplayed: 2 ,
                selectAllText: 'انتخاب همه' // متن فارسی برای انتخاب همه
            });
        });
        function formatNumber(input) {
            // حذف همه کاراکترهای غیر از عدد
            let value = input.value.replace(/\D/g, '');

            // جدا کردن اعداد به صورت سه‌رقمی
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // تنظیم مقدار جدید در input
            input.value = value;
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن محصول جدید</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.product_panel')}}">محصولات</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">افزودن محصول جدید</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.product_panel')}}" class="btn btn-sm btn-danger">
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
                        <form enctype="multipart/form-data" action="{{route('admin.product_store_panel')}}"
                              method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-md-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label>تصویر محصول</label>
                                        @error('product_image')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input name="product_image" type="file" class="form-control dropify">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-9">
                                <div class="row">
                                    <div class="col-12 col-md-8 mb-4">
                                        <label>عنوان محصول</label>
                                        @error('product_name')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{old('product_name')}}" name="product_name" type="text"
                                               class="form-control">
                                    </div>

                                    <div class="col-12 col-md-4 mb-4">
                                        <label>نامک محصول (لاتین)</label>
                                        @error('product_nickname')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{old('product_nickname')}}" dir="ltr" type="text" class="form-control"
                                               name="product_nickname">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>دسته بندی محصول</label>
                                        @error('cat_id')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <div class="multiselect_div">
                                            <select id="category_select"
                                                    class=" form-control"
                                                    name="cat_id">
                                                @foreach($category_info as $category)
                                                    <option value="{{$category['id']}}">
                                                        {{$category['cat_title']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>دسته بندی های اکانت</label>
                                        @error('game_account_id')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <div class="multiselect_div">
                                            <select id="game_account_ids"
                                                    class=" form-control"
                                                    name="game_account_ids[]" multiple>
                                                @foreach($game_account_info as $account)
                                                    <option value="{{$account['id']}}">
                                                        {{$account['account_name']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>موجودی انبار</label>
                                        @error('inventory')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{old('inventory')}}" type="text"
                                               class="form-control" dir="ltr"
                                               name="inventory">
                                    </div>
                                </div>

                                <div class="row  mb-4">
                                    <div class="col-12 col-md-6 mt-4">
                                        <label>قیمت محصول(به دلار بنویسید)</label>
                                        @error('product_price')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input type="text" class="form-control text-right" name="product_price"
                                              >
                                    </div>
                                    <div class="col-12 col-md-6 mt-4">
                                        <label>قیمت فوری محصول(به دلار بنویسید)</label>
                                        @error('product_force_price')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input type="text" class="form-control text-right" name="product_force_price"
                                               >
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-plus mr-2"></i>
                                            افزودن محصول
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
