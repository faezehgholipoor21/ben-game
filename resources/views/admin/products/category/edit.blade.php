@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش دسته بندی
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
                    <h1>ویرایش دسته</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">
                                    پنل مدیریت
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.posts.index')}}">
                                    دسته بندی
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                ویرایش دسته
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.category_product_panel')}}" class="btn btn-sm btn-danger">
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
                              action="{{route('admin.category_product_update_panel', ['id'=> $category_product_edit['id']])}}"
                              method="post"
                              class="row">
                            @csrf
                            <div class="col-12 col-sm-5 col-md-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label>تصویر دسته</label>
                                        @error('cat_image')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input data-default-file="{{asset($category_product_edit['cat_image'])}}"
                                               name="cat_image"
                                               type="file" class="form-control dropify">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-7 col-md-9">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>عنوان دسته</label>
                                        @error('cat_title')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$category_product_edit['cat_title']}}" name="cat_title"
                                               type="text"
                                               class="form-control">
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>دسته والد</label>
                                        @error('cat_title')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <select name="parent" class="form-control">

                                            @foreach($category_info as $cat)
                                                <option value="{{$cat['id']}}"
                                                        @if($cat['id'] == $category_product_edit['parent']) selected="selected" @endif>
                                                    {{$cat['cat_title']}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4 mb-4">
                                        <label>نامک دسته (لاتین)</label>
                                        @error('cat_slug')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <label>
                                            <input dir="ltr" value="{{$category_product_edit['cat_slug']}}" type="text"
                                                   class="form-control"
                                                   name="cat_slug">
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label>محتوای دسته</label>
                                        @error('cat_content')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <textarea name="cat_content"
                                                  class="summernote">{{$category_product_edit['cat_content']}}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label>کلمات کلیدی متا (با enter جدا شود)</label>
                                        @error('cat_meta_keywords')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <div class="input-group demo-tags input-area">
                                            <input name="cat_meta_keywords" type="text" class="form-control"
                                                   value="{{$category_product_edit['cat_meta_keywords']}}"
                                                   data-role="tags input">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <label>توضیحات متا</label>
                                        @error('cat_meta_description')
                                        <span class="validation_label_error">{{$message}}</span>
                                        @enderror
                                        <input value="{{$category_product_edit['cat_meta_description']}}" type="text"
                                               class="form-control" name="cat_meta_description">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <button class="btn btn-success w-100">
                                            <i class="fa fa-edit mr-2"></i>
                                            ویرایش دسته
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
