<?php

namespace App\Http\Controllers\user\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\Images;
use App\Models\User;
use App\Rules\national_code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class userDashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id ;

        $user_info = User::query()
            ->where('id' , $user_id)
            ->first();

        return view('user.dashboard.index',compact('user_info'));
    }

    function profile()
    {
        $genders = Gender::all();

        return view('user.profile.index', compact('genders'));
    }


    function profile_update(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'first_name' => "required|string|max:255",
            'last_name' => "required|string|max:255",
            'national_code' => ["nullable", new national_code],
            'birth_day' => "required|string|max:255",
            'gender' => "string|max:255",
            'mobile' => 'nullable|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'profile' => "nullable|mimes:png,jpg,jpeg|max:2560", //2.5 MG
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors());
        }

        $user = User::query()
            ->where('id', auth()->id())
            ->firstOrFail();

        $user->update([
            'first_name' => $input['first_name'],
            'mobile' => $input['mobile'],
            'last_name' => $input['last_name'],
            'national_code' => $input['national_code'],
            'gender' => $input['gender'],
            'birth_day' => $input['birth_day'] != '' ? $this->convertDateToGregorian($input['birth_day']) : $user['birth_day'],
        ]);

        if ($request->has('profile')) {
            //get profile image and delete old profile
            $images = $user->user_image;
            $placeholder = false;
            if ($images != '' and file_exists($images) and !is_dir($images)) {
                unlink($images);
            }

            $file = $request->file('profile');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'profile_' . time() . '.' . $file_ext;
            $profile = $this->repair_file_src($file->move('site\assets\user_images', $file_name));

            $user->update([
                'user_image' => $profile
            ]);
        }

        alert()->success('','پروفایل با موفقیت ویرایش شد.');
        return back();
    }

    function changePass(Request $request)
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_new_password' => 'required|string|min:8',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors());
        }

        $user_pass = auth()->user()->getAuthPassword();

        $old = $input['old_password'];
        $new = $input['new_password'];
        $confirm = $input['confirm_new_password'];

        if (!password_verify($old, $user_pass)) {
            alert()->error('رمز عبور قبلی صحیح نیست!', 'خطا !');
            return back();
        }

        if ($new != $confirm) {
            alert()->error('کلمه عبور و تکرار آن تطابق ندارند!', 'خطا !');
            return back();
        }

        $user = auth()->user();

        $user->update([
            'password' => password_hash($new, PASSWORD_DEFAULT)
        ]);

        alert()->success('','کلمه عبور با موفقیت تغییر کرد.');
        return redirect()->route('user.dashboard');
    }

    function get_user_image($images, $image_name, $placeholder, $withoutAsset)
    {
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
            if (!$placeholder) {
                return $placeholder;
            } else {
                return '';
            }
        }
    }

    function repair_file_src($src)
    {
        return str_replace('\\', '/', $src);
    }

    function convertDateToGregorian($date)
    {
        $date = explode('/', $date);
        $date = verta()->getGregorian($this->convertDigitsToEnglish($date[0]), $this->convertDigitsToEnglish($date[1]), $this->convertDigitsToEnglish($date[2]));
        return join('-', $date);
    }

    public function convertDateToJalali($date)
    {
        $jalali_date = verta($date)->format('j/%B/Y');
        return $jalali_date;
    }

    function convertDigitsToEnglish($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }
}
