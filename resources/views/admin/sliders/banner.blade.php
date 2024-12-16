@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | عکس بنرها
@endsection

@section('custom-css')
    <style>
        .my_img {
            width: 70px;
            height: 70px;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        $(".dropify").dropify();

        function removeImage(banner_id) {
            var removeModal = $("#RemoveModal");
            var action = "/panel/banner_images_delete/" + banner_id;
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
                    <h1>افزودن عکس بنرها</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                افزودن بنر
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{--        body--}}
        <div class="row clearfix">

            <div class="col-12 col-md-3">
                <form action="{{route('admin.banner_images_store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>
                                        تصویر بنر
                                    </label>
                                    @error('src')
                                    <span class="validation_label_error">{{$message}}</span>
                                    @enderror
                                    <input type="file" name="src" id="src" class="dropify">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>
                                        جمله کوتاه
                                    </label>
                                    @error('tiny_text')
                                    <span class="validation_label_error">{{$message}}</span>
                                    @enderror
                                    <input type="text" name="tiny_text" id="tiny_text" class="form-control"
                                           placeholder="به طور مثال : مجموعه ی داغ">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>
                                        تیتر بنر
                                    </label>
                                    @error('bold_text')
                                    <span class="validation_label_error">{{$message}}</span>
                                    @enderror
                                    <input type="text" name="bold_text" id="bold_text" class="form-control"
                                           placeholder="به طور مثال : پرندگان خشمگین">
                                </div>
                                <div class="col-12 mb-3">
                                    <button type="submit" class="btn btn-success mt-3 w-100">
                                        <i class="fa fa-plus"></i>
                                        افزودن بنر
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
            <div class="col-12 col-md-9">
                @if(!empty($banner_info->all()))
                    <div class="row clearfix">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-custom spacing8">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تصویر محصول</th>
                                        <th>تیتر اسلاید</th>
                                        <th class="text-center">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $row = (($banner_info->currentPage() - 1) * $banner_info->perPage() ) + 1;
                                    @endphp

                                    @foreach($banner_info as $banner)

                                        <tr>
                                            <td class="w60">
                                                <span>{{$row}}</span>
                                            </td>
                                            <td>
                                                <img class="my_img" src="{{asset($banner['src'])}}">
                                            </td>
                                            <td>
                                                {{$banner['bold_text']}}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('admin.banner_images_active' , ['banner_id' => $banner['id']])}}"
                                                   class="{{$banner['css_style']}}">
                                                    <i class="fa fa-image"></i>
                                                    {{$banner['status_text']}}
                                                </a>
                                               @if($banner['is_active'] === 1)
                                                    <a href="{{route('admin.banner_images_de_active' , ['banner_id' => $banner['id']])}}"
                                                       class="btn btn-danger">
                                                        <i class="fa fa-power-off"></i>
                                                        غیرفعال کن
                                                    </a>
                                                @else
                                                    <a href="#"
                                                       class="btn btn-secondary">
                                                        <i class="fa fa-power-off"></i>
                                                        غیرفعال کن
                                                    </a>
                                               @endif
                                                <button onclick="removeImage({{$banner['id']}})"
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

                                {{$banner_info->links()}}
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
                            <h4 class="modal-title">حذف بنر</h4>
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

