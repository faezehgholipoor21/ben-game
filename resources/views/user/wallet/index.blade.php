@extends('layouts.user_layout')

@section('title')
    سایت بنیامین | کیف پول
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('admin/assets/css/persianDatePicker.css')}}">
@endsection

@section('custom-js')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-12">
                <div  class="user-card">
                    <div class="user-card-header">
                        <h4 class="user-card-title">کیف پول</h4>
                        <div class="user-card-header-right">
                            <form action="{{route('user.wallet_pay')}}" method="get">
                                @csrf
                                <input type="text" name="amount" dir="ltr" class="form-control text-center" placeholder="لطفا مبلغ شارژ را وارد کنید">
                                    <button type="submit" class="theme-btn mt-3" style="width: 200px ; display: inline-block">
                                        <i class="fa fa-plus my_i"></i>
                                        شارژ کیف پول
                                    </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="user-card">
                    @if(!empty($wallet_history_list->all()))
                        <div class="table-responsive">
                            <table class="table table-borderless text-nowrap">
                                <thead>
                                <tr>
                                    <th>مقدار (ریال)</th>
                                    <th>نوع تراکنش</th>
                                    <th>تاریخ تراکنش</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wallet_history_list as $wallet_history)
                                    <tr>
                                        <td>
                                            <span class="table-list-code">
                                                {{$wallet_history['amount']}}
                                            </span>
                                        </td>
                                        <td class="{{\App\Helper\WalletTypeTitle::wallet_type_title($wallet_history['type'])[1]}}">
                                            {{\App\Helper\WalletTypeTitle::wallet_type_title($wallet_history['type'])[0]}}
                                        </td>
                                        <td>
                                            {{$wallet_history['jalali_date']}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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

    </div>
@endsection


