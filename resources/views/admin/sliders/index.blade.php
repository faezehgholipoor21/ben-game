@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | عکس اسلایدر
@endsection

@section('custom-css')
    <style>
        .my_img
        {
            width: 170px;
            height: 70px;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        $(".dropify").dropify();

        function removeImage(slider_id) {
            var removeModal = $("#RemoveModal");
            var action = "/panel/slider_images_delete/" + slider_id;
            removeModal.find('form').attr('action', action);
            removeModal.modal('show');
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        {{--        header--}}
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>افزودن عکس اسلایدر</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                افزودن تصویر
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{--        body--}}
        <div class="row clearfix">

                <div class="col-12 col-md-3">
                    <form action="{{route('admin.slider_images_store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="card">
                        <div class="card-body text-center">
                            <label>
                                تصویر اسلاید
                            </label>
                            @error('image_src')
                            <span class="validation_label_error">{{$message}}</span>
                            @enderror
                            <input type="file" name="image_src" id="image_src" class="dropify">
                            <button type="submit" class="btn btn-success mt-3 ">
                                <i class="fa fa-plus"></i>
                                افزودن اسلاید
                            </button>
                        </div>

                    </div>
                    </form>

                </div>
            <div class="col-12 col-md-9">
                @if(!empty($slider_info->all()))
                    <div class="row clearfix">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing8">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تصویر محصول</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $row = (($slider_info->currentPage() - 1) * $slider_info->perPage() ) + 1;
                                    @endphp

                                    @foreach($slider_info as $slider)

                                        <tr>
                                            <td class="w60">
                                                <span>{{$row}}</span>
                                            </td>
                                            <td>
                                                <img class="my_img" src="{{asset($slider['image_src'])}}">
                                            </td>
                                            <td class="text-center">
                                                <button onclick="removeImage({{$slider['id']}})"
                                                        class="btn btn-danger"
                                                        data-toggle="tooltip" title="حذف تصویر">
                                                    <i class="icon-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @php
                                            $row++
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>

                                {{$slider_info->links()}}
                            </div>
                            @else
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="alert alert-danger mb-0">
                                                    موردی یافت نشد.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="RemoveModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">حذف تصویر اسلاید</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <p class="alert alert-danger">
                                آیا از حذف تصویر اطمینان دارید؟
                            </p>
                        </div>

                        <!-- Modal footer -->
                        <form action="" method="post" class="modal-footer">
                            @csrf
                            <button type="submit" class="btn btn-success">بله مطمئنم</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">خیر</button>
                        </form>

                    </div>
                </div>
            </div>
@endsection