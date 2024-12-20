@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش محصول
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
                    <h1>ویرایش محصول</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.product_panel')}}">محصولات</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش محصول</li>
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
                        <form enctype="multipart/form-data"
                              action="{{route('admin.product_update_panel', ['id'=>$product_info['id']])}}"
                              method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-sm-5 col-md-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label>تصویر محصول</label>
                                        @error('product_image')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input data-default-file="{{asset($product_info['product_image'])}}"
                                               name="product_image"
                                               type="file" class="form-control dropify">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label>قیمت محصول(تومان)</label>
                                        @error('product_price')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{number_format($product_info['product_price'])}}" type="text"
                                               class="form-control text-right" name="product_price"
                                               oninput="formatNumber(this)">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label>قیمت فوری محصول(تومان)</label>
                                        @error('product_force_price')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{number_format($product_info['product_force_price'])}}" type="text"
                                               class="form-control text-right" name="product_force_price"
                                               oninput="formatNumber(this)">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-7 col-md-9">
                                <div class="row">
                                    <div class="col-12 col-md-8 mb-4">
                                        <label>عنوان محصول</label>
                                        @error('product_name')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$product_info['product_name']}}" name="product_name"
                                               type="text"
                                               class="form-control">
                                    </div>

                                    <div class="col-12 col-md-4 mb-4">
                                        <label>نامک محصول (لاتین)</label>
                                        @error('product_nickname')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$product_info['product_nickname']}}" type="text"
                                               class="form-control"
                                               name="product_nickname">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>دسته بندی های محصول</label>
                                        @error('cat_id')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <div class="multiselect_div">
                                            <select id="cat_id"
                                                    class=" form-control"
                                                    name="cat_id">
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{$category['id']}}">
                                                        {{$category['cat_title']}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>دسته بندی اکانت محصولات</label>
                                        @error('game_account_id')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <div class="multiselect_div">
                                            <select id="game_account_id"
                                                    class=" form-control"
                                                    name="game_account_id">
                                                @foreach($game_account_id as $game_account)
                                                    <option
                                                        value="{{$game_account['id']}}">
                                                        {{$game_account['account_name']}}
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
                                        <input value="{{$product_info['inventory']}}" type="text"
                                               class="form-control" dir="ltr"
                                               name="inventory">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-12 mb-4">
                                        <label>محتوای محصول</label>
                                        @error('product_content')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="product_content"
                                                  class="summernote">{{$product_info['product_content']}}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label>کلمات کلیدی متا (با enter جدا شود)</label>
                                        @error('product_meta_keywords')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <div class="input-group demo-tagsinput-area">
                                            <input name="product_meta_keywords" type="text" class="form-control"
                                                   value="{{$product_info['product_meta_keywords']}}"
                                                   data-role="tagsinput">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label>توضیحات متا</label>
                                        @error('product_meta_description')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$product_info['product_meta_description']}}" type="text"
                                               class="form-control" name="product_meta_description">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-edit mr-2"></i>
                                            ویرایش محصول
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
