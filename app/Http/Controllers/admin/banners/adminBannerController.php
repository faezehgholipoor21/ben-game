<?php

namespace App\Http\Controllers\admin\banners;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminBannerController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $banner_info = Banner::query()
            ->paginate();

        return view('admin.sliders.banner', compact('banner_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = validator::make($input, [
            'src' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors());
        }

        $banner_active_count = Banner::query()
            ->where('is_active', '=', 1)
            ->count();

        if ($banner_active_count == 0 || $banner_active_count == 1) {
            $file = $request->file('src');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'banner_' . time() . '.' . $file_ext;
            $banner_image = $file->move('site\assets\banners', $file_name);

            Banner::query()->create([
                'src' => RepairFileSrc::repair_file_src($banner_image),
                'tiny_text' => $input['tiny_text'],
                'bold_text' => $input['bold_text'],
            ]);

            alert()->success('', 'بنر جدید با موفقیت افزوده شد.');
            return back();
        } else {
            alert()->success('', 'شما دو بنر فعال دارید لطفا برای انتخاب بنر جدید یک بنر را غیر فعال کنید');
            return back();
        }
    }

    public function delete($banner_id): \Illuminate\Http\RedirectResponse
    {
        $banner_info = Banner::query()->findOrFail($banner_id);

        $old = $banner_info['src'];
        if (file_exists($old) and !is_dir($old)) {
            unlink($old);
        }
        $banner_info->delete();
        return back();
    }

    public function active($banner_id): \Illuminate\Http\RedirectResponse
    {
        $banner_info = Banner::query()->findOrFail($banner_id);

        $banner_active_count = Banner::query()
            ->where('is_active', '=', 1)
            ->count();
        if ($banner_active_count == 0 || $banner_active_count == 1) {

            if ($banner_info['is_active'] == 1) {
                $banner_info->update([
                    'is_active' => 0,
                    'css_style' => 'btn btn-warning',
                    'status_text' => 'عدم نمایش در سایت',
                ]);
            } elseif ($banner_info['is_active'] == 0) {
                $banner_info->update([
                    'is_active' => 1,
                    'css_style' => 'btn btn-success',
                    'status_text' => 'قابل نمایش در سایت',
                ]);
            }
            alert()->success('', 'تغییر  با موفقیت اعمال شد.');
            return back();
        } else {
            alert()->success('', 'شما دو بنر فعال دارید لطفا برای انتخاب بنر جدید یک بنر را غیر فعال کنید');
            return back();
        }
    }
    public function de_active($banner_id): \Illuminate\Http\RedirectResponse
    {
        $banner_info = Banner::query()->findOrFail($banner_id);
        $banner_info->update([
            'is_active' => 0,
            'css_style' => 'btn btn-warning',
            'status_text' => 'عدم نمایش در سایت',
        ]);
        alert()->success('', 'تغییر  با موفقیت اعمال شد.');
        return back();
    }
}
