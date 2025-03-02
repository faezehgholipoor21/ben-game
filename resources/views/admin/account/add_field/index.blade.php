@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | فیلدهای اکانت
@endsection

@section('custom-js')
    <script>
        function removeAccount(id) {
            const removeModal = $("#RemoveModal");
            const action = "/panel/field_delete/" + id;
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
                    <h1>اکانت ها</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">فیلدهای اکانت</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.game_account_add_field')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus mr-2"></i>
                        افزودن فیلد جدید اکانت
                    </a>
                    <a href="{{route('admin.game_account_panel')}}" class="btn btn-sm btn-danger">
                        <i class="fa fa-angle-right mr-2"></i>
                        بازگشت به لیست اکانت ها
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                @if(!empty($game_account_field_info->all()))
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان فیلد اکانت</th>
                                <th>تگ فیلد اکانت</th>
                                <th>نوع فیلد اکانت</th>
                                <th>نام فیلد اکانت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $row = (($game_account_field_info->currentPage() - 1) * $game_account_field_info->perPage() ) + 1;
                            @endphp
                            @foreach($game_account_field_info as $field)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$field['label']}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$field['tag']}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$field['type']}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$field['name']}}
                                        </p>
                                    </td>
                                    <td>
                                        <button onclick="removeAccount({{$field['id']}})"
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

                        {{$game_account_field_info->links()}}
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
                    <h4 class="modal-title">حذف فیلد</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="alert alert-danger">
                        آیا از حذف فیلد اطمینان دارید؟
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
