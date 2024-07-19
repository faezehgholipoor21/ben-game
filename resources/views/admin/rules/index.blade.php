@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | قوانین
@endsection

@section('custom-css')
    <style>
        .my_img{
            width: 70px;
            height: 70px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .my_th, .my_td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center; /* مرکزچین کردن متن به صورت افقی */
            vertical-align: middle; /* مرکزچین کردن متن به صورت عمودی */
            width: 50%; /* تنظیم عرض سلول، می‌توانید بر حسب نیاز تغییر دهید */
        }
        .my_td {
            word-break: break-word; /* اطمینان از شکستن کلمات طولانی */
        }
    </style>
@endsection

@section('custom-js')
    <script>
        function removeRule(id) {
            const removeModal = $("#RemoveModal");
            const action = "/panel/rule_delete/" + id;
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
                    <h1>قوانین</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">قوانین</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.rule_create_panel')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus mr-2"></i>
                        افزودن قانون جدید
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                @if(!empty($rule_info->all()))
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8 table-container">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان عکس</th>
                                <th>موضوع</th>
                                <th class="my_th">پیشگفتار</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $row = (($rule_info->currentPage() - 1) * $rule_info->perPage() ) + 1;
                            @endphp
                            @foreach($rule_info as $rule)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>
                                    <td>
                                        <img src="{{asset($rule['image_src'])}}" class="my_img" alt="">
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$rule['title']}}
                                        </p>
                                    </td>
                                    <td class="my_td">
                                        <p class="mb-0">
                                            {!! $rule['topic'] !!}
                                        </p>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.rule_edit_panel', ['id' => $rule['id']])}}">
                                            <button class="btn btn-primary">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </a>
                                        <button onclick="removeRule({{$rule['id']}})"
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
                        {{$rule_info->links()}}
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
                    <h4 class="modal-title">حذف قانون</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="alert alert-danger">
                        آیا از حذف این قانون اطمینان دارید؟
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
