@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | باشگاه مشتریان
@endsection

@section('custom-css')
    <style>
        .sub_img{
            width: 100px;
            height: 100px;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        function removeMembership(id) {
            const removeModal = $("#RemoveModal");
            const action = "/panel/membership_delete/" + id;
            removeModal.find('form').attr('action', action);
            removeModal.modal('show');
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>اشتراک ها</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">باشگاه مشتریان</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.membership_day')}}" class="btn btn-sm btn-warning">
                        <i class="fa fa-check mr-2"></i>
                        تنظیم تعداد روزهای باشگاه
                    </a>
                    <a href="{{route('admin.membership_create')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus mr-2"></i>
                        افزودن سطح جدید
                    </a>

                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                @if(!empty($membership_list->all()))
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان سطح</th>
                                <th>درصد تخفیف</th>
                                <th>ارتقا سطح</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $row = (($membership_list->currentPage() - 1) * $membership_list->perPage() ) + 1;
                            @endphp
                            @foreach($membership_list as $member)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$member['name']}}
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            {{$member['discount'] . ' % ' }}
                                        </p>
                                    </td>
                                    <td>
                                        {{$member['require_point'] . ' $ '}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.membership_edit', ['member_id' => $member['id']])}}">
                                            <button class="btn btn-primary">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </a>

                                        <button onclick="removeMembership({{$member['id']}})"
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

                        {{$membership_list->links()}}
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
                    <h4 class="modal-title">حذف سطح</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="alert alert-danger">
                        آیا از حذف سطح اطمینان دارید؟
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

