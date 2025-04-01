@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | تخفیف
@endsection

@section('custom-css')
@endsection

@section('custom-js')
    <script>
        function removeDiscount(id) {
            let removeModal = $("#RemoveModal");
            let action = "/panel/discount_delete/" + id;
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
                    <h1>تخفیف</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">تخفیف</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.discount_create')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus mr-2"></i>
                        افزودن تخفیف جدید
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                @if(!empty($discounts->all()))
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان تخفیف</th>
                                <th>کد تخفیف</th>
                                <th>تاریخ انقضا</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $row = (($discounts->currentPage() - 1) * $discounts->perPage() ) + 1;
                            @endphp
                            @foreach($discounts as $discount)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>

                                    <td>
                                        <p class="mb-0">
                                            {{$discount['discount_name']}}
                                        </p>
                                    </td>

                                    <td>
                                        <p class="mb-0">
                                            {{$discount['discount_code']}}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$discount['jalali_date']}}
                                        </p>
                                    </td>

                                    <td>
                                        <a href="{{route('admin.discount_edit', ['discount_id' => $discount['id']])}}">
                                            <button class="btn btn-primary" data-toggle="tooltip" title="ویرایش تخفیف">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </a>

                                        <button onclick="removeDiscount({{$discount['id']}})" class="btn btn-danger" data-toggle="tooltip" title="حذف مقاله">
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

                        {{$discounts->links()}}
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
                    <h4 class="modal-title">حذف تخفیف</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="alert alert-danger">
                        آیا از حذف تخفیف اطمینان دارید؟
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
