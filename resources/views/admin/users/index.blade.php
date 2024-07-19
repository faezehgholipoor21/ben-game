@extends('layouts.admin_layout')

@section('Title')پنل مدیریت | کاربران@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>کاربران</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.dashboard')}}">
                                    پنل مدیریت
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">کاربران</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <form method="post" action="{{route('admin.users.search')}}" class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3 mb-4">
                                <label>نام</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="col-12 col-sm-6 col-md-3 mb-4">
                                <label>نام خانوادگی</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            @if(!$searched)
                                <div class="col-12 col-sm-6 col-md-3 mb-4">
                                    <button type="submit" class="btn btn-success w-100 mt-29">
                                        <i class="fa fa-search mr-2"></i>
                                        فیلتر کنید
                                    </button>
                                </div>
                            @else
                                <div class="col-12 col-md-2 mb-4">
                                    <a href="{{route('admin.users')}}" class="btn btn-danger w-100 mt-29">
                                        <i class="fa fa-times-circle mr-2"></i>
                                        حذف فیلتر
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-md-2 mb-4">
                                    <button type="submit" class="btn btn-success w-100 mt-29">
                                        <i class="fa fa-search mr-2"></i>
                                        فیلتر کنید
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom spacing8">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام و نام خانوادگی</th>
                                <th>موبایل</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$searched and $users->lastPage() > 1)
                                @php
                                    $row = (($users->currentPage() - 1) * $users->perPage() ) + 1;
                                @endphp
                            @else
                                @php
                                    $row = 1;
                                @endphp
                            @endif
                            @foreach($users as $user)
                                <tr>
                                    <td class="w60">
                                        <span>{{$row}}</span>
                                    </td>

                                    <td>
                                        <p class="mb-0">
                                            {{$user['first_name'] . ' ' . $user['last_name']}}
                                        </p>
                                    </td>

                                    <td>
                                        {{$user['mobile']}}
                                    </td>

                                    <td>
                                        @if($user['id'] == auth()->id())
                                            <a href="#" disabled="disabled">
                                                <button class="btn btn-primary">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                            </a>
                                        @else
                                            <a href="#" disabled="disabled">
                                                <button class="btn btn-primary" >
                                                    <i class="icon-pencil"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $row++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(!$searched and $users->lastPage() > 1)
                        <div class="bg-white p-2 mt--15px">
                            {{$users->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
