@extends('layouts.user_layout')

@section('title')
    اکانت های من
@endsection

@section('custom-css')
    <style>
        .my_i {
            margin-left: 5px !important;
        }

        .theme-red {
            background: #dd0628 !important;
            color: #ffffff !important;
            padding: 5px 20px;
            border-radius: 10px;
            font-size: 12px;
            text-transform: capitalize;
            font-weight: 500;
            cursor: pointer;
            text-align: center;
            overflow: hidden;
            border: none;
            position: relative;
            display: inline-block;
            vertical-align: middle;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            z-index: 1;
        }

        .theme-red i {
            font-size: 12px;
        }

        .account_fields_row {
            display: none;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        function updateFields(tag) {
            let selected_value = $(tag).find("option:selected").val()
            $(".account_fields_row").hide()
            $(".account_fields_row[data-account="+ selected_value +"]").show().css("display", "flex");
        }
    </script>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="user-card">
                <div class="user-card-header">
                    <h4 class="user-card-title">اکانت های من</h4>
                    <div class="user-card-header-right">
                        <a href="{{route('user.accounts')}}" class="theme-red">
                            <i class="fa fa-arrow-right my_i"></i>
                            بازگشت
                        </a>
                    </div>
                </div>

                <label>
                    اکانت خود را انتخاب کنید
                </label>

                <form method="POST" action="#">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                            <select class="form-control" name="game_account_id" id="game_account_select"
                                    onchange="updateFields(this)">
                                <option>انتخاب کنید</option>

                                @foreach($game_accounts as $game_account)
                                    <option value="{{ $game_account->id }}">{{ $game_account->account_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @foreach($game_accounts as $game_account)
                        <div data-account="{{$game_account['id']}}" class="row account_fields_row">
                            @foreach($game_account['fields'] as $field)
                                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                    <label>{{$field['label']}}</label>
                                    <input type="{{$field['type']}}" class="form-control">
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </form>

            </div>
        </div>
    </div>
@endsection



