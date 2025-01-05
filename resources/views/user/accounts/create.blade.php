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
            $(".account_fields_row[data-account=" + selected_value + "]").show().css("display", "flex");
        }

        function addNewAccountSubmitForm() {
            let newAccountForms = $(".newAccountForms:visible")

            let game_account_select_value = $("#game_account_select").find("option:selected").val()
            $(".game_account_select_hidden").val(game_account_select_value)

            newAccountForms.submit()
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

                <div class="row mb-4">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                        <label>اکانت خود را انتخاب کنید</label>
                        <select class="form-control" id="game_account_select"
                                onchange="updateFields(this)">
                            <option>انتخاب کنید</option>

                            @foreach($game_accounts as $game_account)
                                <option value="{{ $game_account->id }}">{{ $game_account->account_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @foreach($game_accounts as $game_account)
                    <form method="POST" action="{{route('user.account_store')}}" data-account="{{$game_account['id']}}"
                          class="row account_fields_row newAccountForms">
                        <select name="game_account" class="form-control game_account_select_hidden d-none"
                                onchange="updateFields(this)">
                            <option>انتخاب کنید</option>

                            @foreach($game_accounts as $a_game_account)
                                <option value="{{ $a_game_account->id }}">{{ $a_game_account->account_name }}</option>
                            @endforeach
                        </select>
                        @foreach($game_account['fields'] as $field)
                            @csrf
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <label>{{$field['label']}}</label>
                                <input type="{{$field['type']}}" class="form-control" name="field_{{$field['id']}}">
                            </div>
                        @endforeach
                    </form>
                @endforeach

                <div class="row mt-4">
                    <div class="col-12">
                        <button onclick="addNewAccountSubmitForm()" class="btn btn-sm theme-btn">
                            افزودن
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



