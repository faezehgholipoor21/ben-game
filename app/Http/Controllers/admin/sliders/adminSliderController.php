<?php

namespace App\Http\Controllers\admin\sliders;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\ImageSetting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class adminSliderController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $slider_info = Slider::query()
            ->paginate();

        return view('admin.sliders.index', compact('slider_info'));
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

        $file = $request->file('src');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'slider_' . time() . '.' . $file_ext;
        $slider_image = $file->move('site\assets\sliders', $file_name);

        Slider::query()->create([
            'src' => RepairFileSrc::repair_file_src($slider_image),
            'discount_text' => $input['discount_text'],
            'bold_text' => $input['bold_text'],
            'description' => $input['description'],
        ]);

        alert()->success('', 'عکس جدید با موفقیت افزوده شد.');
        return back();

    }

    public function delete($slider_id): \Illuminate\Http\RedirectResponse
    {
        $slider_info = Slider::query()->findOrFail($slider_id);

        $old = $slider_info['src'];
        if (file_exists($old) and !is_dir($old)) {
            unlink($old);
        }

        $slider_info->delete();

        return back();
    }

    public function active($slider_id): \Illuminate\Http\RedirectResponse
    {
        $slider_info = Slider::query()->findOrFail($slider_id);

        if ($slider_info['is_active'] == 1) {
            $slider_info->update([
                'is_active' => 0 ,
                'css_style' => 'btn btn-danger' ,
                'status_text' => 'عدم نمایش در سایت' ,
            ]);
        } elseif ($slider_info['is_active'] == 0) {
            $slider_info->update([
                'is_active' => 1 ,
                'css_style' => 'btn btn-success' ,
                'status_text' => 'قابل نمایش در سایت' ,
            ]);

        }
        alert()->success('', 'تغییر  با موفقیت اعمال شد.');
        return back();
    }
}
