@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | محصولات
@endsection

@section('custom-css')
    <style>
        .my_img {
            width: 80px;
            height: 80px;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        function putComma(Number) {
            Number += '';
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            Number = Number.replace(',', '');
            x = Number.split('.');
            y = x[0];
            z = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(y))
                y = y.replace(rgx, '$1' + ',' + '$2');
            return y + z;
        }

        function removeComma(Number) {
            return Number.replace(/,/g, '');
        }

        function setComma(tag) {
            var value = $(tag).val();
            value = removeComma(value);
            value = putComma(value);
            $(tag).val(value);
            return true;
        }

        function removeProduct(id) {
            var removeModal = $("#RemoveModal");
            var action = "/panel/product_delete/" + id;
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
                    <h1>محصولات</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">محصولات</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.product_create_panel')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus mr-2"></i>
                        افزودن محصولات جدید
                    </a>
                </div>
            </div>
        </div>
        @if(!empty($product_info->all()))
            <div class="row clearfix">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">تصویر محصول</th>
                                <th class="text-center">عنوان محصول</th>
                                <th class="text-center">دسته محصول</th>
                                <th class="text-center">اکانت بازی</th>
                                <th class="text-center">قیمت (تومان)</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $row = (($product_info->currentPage() - 1) * $product_info->perPage() ) + 1;
                            @endphp

                            @foreach($product_info as $product)

                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>
                                    <td>
                                        <img src="{{asset($product['product_image'])}}" class="my_img">
                                    </td>
                                    <td class="text-center">
                                        <p class="mb-0">
                                            {{$product['product_name']}}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <p class="mb-0">
                                            {{$product['cat_title']}}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        @foreach($product->accounts as $account)
                                            <p class="badge badge-info">
                                                {{ $account->account_name }}
                                            </p>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <p class="mb-0">
                                            {{number_format(\App\Helper\ChangeDollar::change_dollar($product['product_price']))}}
                                        </p>
                                    </td>
                                    <td class="text-center">


                                        <a href="{{route('admin.product_edit_panel',['id'=>$product['id']])}}">
                                            <button class="btn btn-primary" data-toggle="tooltip"
                                                    title="ویرایش محصولات">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </a>
                                        <button onclick="removeProduct({{$product['id']}})" class="btn btn-danger"
                                                data-toggle="tooltip" title="حذف محصول">
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

                        {{$product_info->links()}}
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
                    <h4 class="modal-title">حذف محصولات</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="alert alert-danger">
                        آیا از حذف محصول اطمینان دارید؟
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
