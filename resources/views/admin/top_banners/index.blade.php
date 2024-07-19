@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | عکس بنرها
@endsection

@section('custom-css')
    <style>
        .my_img {
            width: 170px;
            height: 70px;
        }
    </style>
@endsection

@section('custom-js')

    <script>
        $(".dropify").dropify();

        function removeImage(top_banner_id) {
            var removeModal = $("#RemoveModal");
            var action = "/panel/top_banner_images_delete/" + top_banner_id;
            removeModal.find('form').attr('action', action);
            removeModal.modal('show');
        }

        function show_banner(top_banner_id) {
            var url = "/panel/show_banner/";
            var data = {
                _token: '{{csrf_token()}}',
                top_banner_id: top_banner_id
            };

            $.post(
                url,
                data,
                function (result){
                    if(result.status){
                        location.reload();
                    }
                    else{
                        swal.fire({
                            html: result.message,
                            timer: 3000,
                            showConfirmButton:false,
                            timerProgressBar:true,
                            icon: "warning"
                        });

                        setTimeout(function(){
                            window.location.reload(1);
                        }, 3000);

                    }
                },
            'json'
            );

        }

        function deactive_banners(){
            var url = "/panel/deactive_banner/";
            var data = {
                _token: '{{csrf_token()}}'
            };

            $.post(
                url,
                data,
                function (result){
                    if(result.status){

                        swal.fire({
                            html: result.message,
                            timer: 3000,
                            showConfirmButton:false,
                            timerProgressBar:true,
                            icon: "success"
                        });

                        setTimeout(function(){
                            window.location.reload(1);
                        }, 3000);


                    }
                    else{
                        alert(result.message);
                    }
                },
                'json'
            );
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
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                افزودن تصویر
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a onclick="deactive_banners()" class="btn btn-sm btn-danger text-white">
                        <i class="fa fa-minus mr-2"></i>
                        غیرفعال کردن تصاویر
                    </a>
                </div>
            </div>
        </div>
        {{--        body--}}
        <div class="row clearfix">

            <div class="col-12 col-md-3">
                <form action="{{route('admin.top_banner_images_store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body text-center">
                            <label>
                                تصویر بنر
                            </label>
                            @error('image_src')
                            <span class="validation_label_error">{{$message}}</span>
                            @enderror
                            <input type="file" name="image_src" id="image_src" class="dropify">
                            <button type="submit" class="btn btn-success mt-3 ">
                                <i class="fa fa-plus"></i>
                                افزودن بنر
                            </button>
                        </div>

                    </div>
                </form>

            </div>
            <div class="col-12 col-md-9">
                @if(!empty($top_banner_info->all()))
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
                                        $row = (($top_banner_info->currentPage() - 1) * $top_banner_info->perPage() ) + 1;
                                    @endphp

                                    @foreach($top_banner_info as $banner)

                                        <tr>
                                            <td class="w60">
                                                <span>{{$row}}</span>
                                            </td>
                                            <td>
                                                <img class="my_img" src="{{asset($banner['image_src'])}}">
                                            </td>
                                            <td class="text-center">
                                                <a onclick="show_banner({{$banner['id']}})"
                                                   class="{{$banner['image_css']}}">
                                                    <i class="fa fa-eye"></i>
                                                    نمایش در سایت
                                                </a>
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

                                {{$top_banner_info->links()}}
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
                            <h4 class="modal-title">حذف تصویر بنر</h4>
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
