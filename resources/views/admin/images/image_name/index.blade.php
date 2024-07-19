@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | فیلد عکس ها
@endsection

@section('custom-css')
    <style>
        .my_img{
            width: 70px;
            height: 70px;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        function removeImage(id) {
            const removeModal = $("#RemoveModal");
            const action = "/panel/images_delete/" + id;
            removeModal.find('form').attr('action', action);
            removeModal.modal('show');
        }

        function activate(image_id) {
            var url = "/panel/image_activate_panel/";
            var data = {
                _token: '{{csrf_token()}}',
                image_id: image_id
            };

            $.ajax({
                url : url,
                type: "POST",
                contentType : 'application/json' ,
                processData : false ,
                data : JSON.stringify(data) ,
                success:function (response){
                    if(response.error){
                        swal.fire({
                            html:'<p>' + response.message + '</p>' ,
                            icon : 'error' ,
                            showConfirmButton : false ,
                            timerProgressBar : true ,
                        })
                        setInterval(function (){
                            location.reload();
                        },3000);
                    }
                    else{
                        swal.fire({
                            html:'<p>' + response.message + '</p>' ,
                            icon : 'success' ,
                            showConfirmButton : false ,
                            timerProgressBar : true ,
                        })
                        setInterval(function (){
                            location.reload();
                        },3000);
                    }
                }
                ,error:function (xhr , status ,error){
                    console.log("Error : " + error);
                }
            });
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>اکانت ها</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">فیلد عکس ها</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.images_create_panel')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus mr-2"></i>
                        افزودن فیلد عکس جدید
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                @if(!empty($images_info->all()))
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان عکس</th>
                                <th>نوع عکس</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $row = (($images_info->currentPage() - 1) * $images_info->perPage() ) + 1;
                            @endphp
                            @foreach($images_info as $image)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>
                                    <td>
                                        <img src="{{asset($image['image_name'])}}" class="my_img" alt="">
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$image['image_type_id']}}
                                        </p>
                                    </td>
                                    <td>
                                        <a onclick="activate({{$image['id']}})" class="{{$image['image_css']}}">
                                            <i class="fa fa-check"></i>
                                            {{$image['css_title']}}
                                        </a>
                                        <a href="{{route('admin.images_edit_panel', ['id' => $image['id']])}}">
                                            <button class="btn btn-primary">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </a>

                                        <button onclick="removeImage({{$image['id']}})"
                                                class="btn btn-danger">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>

                        {{$images_info->links()}}
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
                    <h4 class="modal-title">حذف عکس</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="alert alert-danger">
                        آیا از حذف فیلد عکس اطمینان دارید؟
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
