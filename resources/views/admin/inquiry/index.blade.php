@extends('layouts.admin_layout')

@section('Title')
@endsection

@section('custom-css')
@endsection

@section('custom-js')
    <script>


        function show_detail_modal(inquiry_id) {
            var url = "/panel/inquiry_detail_panel/"+inquiry_id;
            var data = {
                _token: '{{csrf_token()}}',
                inquiry_id: inquiry_id
            };

            $.post(
                url,
                data,
                function (result){
                    if(result.status){
                        document.getElementById("company_name").innerHTML = result.company_name;
                        document.getElementById("phone").innerHTML = result.phone;
                        document.getElementById("description").innerHTML = result.description;
                        $('#DetailModal').show();
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


    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>استعلام</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">استعلام</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                @if(!empty($inquiry_info->all()))
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام مشتری</th>
                                <th>تلفن همراه</th>
                                <th>محصول</th>
                                <th>تعداد محصول</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $row = (($inquiry_info->currentPage() - 1) * $inquiry_info->perPage() ) + 1;
                            @endphp
                            @foreach($inquiry_info as $item)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>

                                    <td>
                                        <p class="mb-0">
                                            {{$item['user_name']}}
                                        </p>
                                    </td>

                                    <td>
                                        <p class="mb-0">
                                            {{$item['mobile']}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$item['product_name']}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$item['number_product']}}
                                        </p>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" onclick="show_detail_modal({{$item['id']}})">
                                            <i class="icon-list"></i>
                                        </a>
                                        <a href="{{route('admin.inquiry_update_panel',['inquiry_id'=>$item['id']])}}"
                                           class="{{$item['css_style']}}" data-toggle="tooltip" title="حذف مقاله">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a href="{{route('admin.inquiry_delete_panel',['inquiry_id'=>$item['id']])}}"
                                           class="btn btn-danger" data-toggle="tooltip" title="حذف مقاله">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>

                        {{$inquiry_info->links()}}
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
    <div class="modal" id="DetailModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">نمایش جزئیات استعلام</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert alert-info">
                        <label>شرکت : </label>
                    <p class="alert alert-warning p-2" id="company_name"></p>
                    </div>

                    <div class="alert alert-info">
                        <label>تلفن : </label>
                        <p class="alert alert-warning p-2" id="phone"></p>
                    </div>

                    <div class="alert alert-info">
                        <label>توضیحات : </label>
                        <p class="alert alert-warning p-2" id="description"></p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">متوجه شدم</button>
                </div>
                <!-- Modal footer -->
{{--                    <button type="button" class="btn btn-success" data-dismiss="modal">متوجه شدم</button>--}}

            </div>
        </div>
    </div>
@endsection
