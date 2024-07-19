@extends('layouts.admin_layout')

@section('Title')
    پنل مدیریت | ویرایش فیلد
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>ویرایش فیلد اکانت</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">پنل مدیریت</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.game_account_field_panel')}}">فیلد ها</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">ویرایش فیلد
                                ({{$account_field_info['field_title']}})
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-sm-12 text-right hidden-xs">
                    <a href="{{route('admin.game_account_field_panel')}}" class="btn btn-sm btn-danger">
                        <i class="fa fa-angle-right mr-2"></i>
                        بازگشت
                    </a>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form
                            action="{{route('admin.game_account_field_update_panel', ['id' => $account_field_info['id']])}}"
                            method="post" class="row">
                            @csrf
                            <div class="col-12 col-sm-4 col-md-3">
                                <label>عنوان فیلد</label>
                                @error('field_title')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <input required type="text" class="form-control" name="field_title"
                                       value="{{$account_field_info['field_title']}}">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <label>نوع اکانت</label>
                                @error('account_name')
                                <span class="validation_label_error">{{$message}}</span>
                                @enderror
                                <div class="multiselect_div">
                                    <select id="account_name_id"
                                            class="form-control"
                                            name="account_name_id">
                                        @foreach($account_info as $item)
                                            <option value="{{$item['id']}}">
                                                {{$item['account_name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button type="submit" class="btn btn-success w-100 mt-29">ویرایش فیلد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
