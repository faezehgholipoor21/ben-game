@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | دسته بندی سوالات متدوال
@endsection

@section('custom-js')
    <script>
        function removeFaqCategory(id) {
            const removeModal = $("#RemoveModal");
            const action = "/panel/faq_category_delete/" + id;
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
                    <h1>دسته بندی سوالات متدوال</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item active" aria-current="page">دسته بندی سوالات متدوال</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.faq_category_create_panel')}}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus mr-2"></i>
                        افزودن دسته بندی جدید سوالات متداول
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                @if(!empty($faq_category_info->all()))
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان دسته بندی</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $row = (($faq_category_info->currentPage() - 1) * $faq_category_info->perPage() ) + 1;
                            @endphp
                            @foreach($faq_category_info as $faq_category)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{$faq_category['faq_title']}}
                                        </p>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.faq_category_edit_panel', ['id' => $faq_category['id']])}}">
                                            <button class="btn btn-primary">
                                                <i class="icon-pencil"></i>
                                            </button>
                                        </a>
                                        <button onclick="removeFaqCategory({{$faq_category['id']}})"
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
                        {{$faq_category_info->links()}}
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
                    <h4 class="modal-title">حذف دسته بندی</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p class="alert alert-danger">
                        آیا از حذف دسته بندی اطمینان دارید؟
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
