<?php

namespace App\Http\Controllers\admin;

use App\Helper\GetUserRoleNameByUserId;
use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\UserStatus;
use App\Rules\national_code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\ConvertDateToGregorian;

class adminUserController extends Controller
{
    function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()
            ->select('*', 'users.id as user_id')
            ->leftJoin('genders', 'genders.gender_id', '=', 'users.gender')
            ->latest()
            ->paginate(15);

        $searched = false;
        foreach ($users as $user) {
            $user['user_role_info'] = GetUserRoleNameByUserId::get_user_role_name_by_user_id($user['id']);
        }
        return view('admin.users.index', compact('users', 'searched'));
    }

    function search(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $input = $request->all();

        if ($request->has('first_name') and $input['first_name'] != '') {
            $first_name = $input['first_name'];
        } else {
            $first_name = '';
        }

        if ($request->has('last_name') and $input['last_name'] != '') {
            $last_name = $input['last_name'];
        } else {
            $last_name = '';
        }

        if ($request->has('mobile') and $input['mobile'] != '') {
            $mobile = $input['mobile'];
        } else {
            $mobile = '';
        }

//        if ($request->has('gender') and $input['gender'] != '') {
//            $gender = $input['gender'];
//        } else {
//            $gender = 0;
//        }

        $users = User::query()
            ->select('*', 'users.id as user_id')
            ->leftJoin('genders', 'genders.gender_id', '=', 'users.gender')
            ->when($first_name != '', function ($q) use ($first_name) {
                $q->where('users.first_name', 'like', '%' . $first_name . '%');
            })
            ->when($last_name != '', function ($q) use ($last_name) {
                $q->where('users.last_name', 'like', '%' . $last_name . '%');
            })
            ->when($mobile != '', function ($q) use ($mobile) {
                $q->where('users.mobile', 'like', '%' . $mobile . '%');
            })
//            ->when($gender != 0, function ($q) use ($gender) {
//                $q->where('users.gender', $gender);
//            })
            ->latest('users.created_at')
            ->get();

        foreach ($users as $user) {
            $user['user_role_info'] = GetUserRoleNameByUserId::get_user_role_name_by_user_id($user['id']);
        }

        $searched = true;
        return view('admin.users.index', compact('users', 'searched'));
    }

    function edit($user_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $this_user_info = User::query()
            ->select('*', 'users.id as user_id')
            ->leftJoin('genders', 'genders.gender_id', '=', 'users.gender')
            ->where('id', $user_id)
            ->firstOrFail();

        $role_info = Role::query()
            ->get();

        $user_role_info = RoleUser::query()
            ->where('user_id', $this_user_info['user_id'])
            ->first();

        $role_id = $user_role_info['role_id'];

        //get profile image
//        $images = $this_user_info->images;
//        $placeholder = asset('admin/assets/image_name/placeholders/user_placeholder.png');
//        $profile = $this->get_user_image($images, 'profile', $placeholder, false);
//        $this_user_info['profile'] = $profile;

        $genders = Gender::all();

        $user_status = UserStatus::query()->get();

        return view('admin.users.edit', compact('this_user_info', 'genders','user_status', 'role_info', 'role_id', 'user_role_info'));
    }

    function update(Request $request, $user_id)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'status' => "required|integer|max:1",
            'first_name' => "required|string|max:255",
            'last_name' => "required|string|max:255",
            'national_code' => ["nullable", new national_code],
            'birth_day' => "nullable|string|max:255",
            'gender' => "string|max:255",
            'mobile' => 'nullable|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'user_image' => "nullable|mimes:png,jpg,jpeg|max:2560", //2.5 MG
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors());
        }

        $user = User::query()
            ->where('id', $user_id)
            ->firstOrFail();

        $user->update([
            'is_active' => intval($input['status']),
            'first_name' => $input['first_name'],
            'mobile' => $input['mobile'],
            'last_name' => $input['last_name'],
            'national_code' => $input['national_code'],
            'gender' => $input['gender'],
            'user_status_id' => intval($input['auth_status']),
            'birth_day' => $input['birth_day'] != '' ? ConvertDateToGregorian::convert_date_to_gregorian($input['birth_day']) : $user['birth_day'],
        ]);

        $role_user_info = RoleUser::query()
            ->where('user_id', $user['id'])
            ->first();

        $role_user_info->update([
            'role_id' => $input['role']
        ]);

        if ($request->has('user_image')) {
            //get posts image and delete old profile
            $old = $user->user_image;
            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('user_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'user_image_' . time() . '.' . $file_ext;
            $user_image = $file->move('site/assets/user_image', $file_name);

            $user->update([
                'user_image' => RepairFileSrc::repair_file_src($user_image),
            ]);
        }

        alert()->success('','کاربر با موفقیت ویرایش شد.');
        return back();
    }

    function get_user_image($images, $image_name, $placeholder, $withoutAsset)
    {
        $profile = $placeholder;
        foreach ($images as $image) {
            if ($image['image_name'] == $image_name) {
                $profile = $image->pivot->image_src;
                break;
            }
        }

        if (file_exists($profile) and !is_dir($profile)) {
            if ($withoutAsset) {
                return $profile;
            } else {
                return asset($profile);
            }
        } else {
            if ($placeholder) {
                return $placeholder;
            } else {
                return '';
            }
        }
    }

}
