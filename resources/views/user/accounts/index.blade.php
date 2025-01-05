@extends('layouts.user_layout')

@section('title')
    اکانت های من
@endsection

@section('custom-css')
    <style>
        .my_i {
            margin-left: 5px !important;
        }
    </style>
@endsection


@section('custom-js')
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="user-card">
                <div class="user-card-header">
                    <h4 class="user-card-title">اکانت های من</h4>
                    <div class="user-card-header-right">
                        <a href="{{route('user.account_create')}}" class="theme-btn">
                            <i class="fa fa-plus my_i"></i>
                            تعریف اکانت جدید
                        </a>
                    </div>
                </div>
                @if(!empty($accounts->all()))
                    <table class="table table-bordered text-center">
                        <tr>
                            <td>نوع اکانت</td>
                            <td>عملیات</td>
                        </tr>

                        @foreach($accounts as $account)
                            <tr>
                                <td>{{$account['account']['account_name']}}</td>
                                <td>
                                    @if(\App\Helper\GetActiveAccount::get_active_account($account['unique_form']) == 1)
                                        <label class="btn btn-success">
                                            اکانت پیش فرض
                                        </label>
                                    @else
                                        <a href="{{route('user.account_is_default' , ['user_account_id' => $account['user_id'] , 'unique_form' => $account['unique_form']])}}"
                                           class="btn btn-warning">
                                            پیش فرض
                                        </a>
                                    @endif

                                    <button class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="alert alert-warning">
                        اکانتی تعریف نشده است
                    </p>
                @endif

            </div>
        </div>
    </div>
@endsection



