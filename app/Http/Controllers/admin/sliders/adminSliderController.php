<?php

namespace App\Http\Controllers\admin\sliders;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\ImageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class adminSliderController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $slider_info = ImageSetting::query()
            ->where('image_id', 3)
            ->paginate();

        return view('admin.sliders.index', compact('slider_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = validator::make($input, [
            'image_src' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors());
        }

        $file = $request->file('image_src');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'slider_' . time() . '.' . $file_ext;
        $slider_image = $file->move('site\assets\sliders', $file_name);

        ImageSetting::query()->create([
            'image_id' => 3,
            'image_src' => RepairFileSrc::repair_file_src($slider_image),
            'is_main' => 1,
        ]);

        alert()->success('', 'عکس جدید با موفقیت افزوده شد.');
        return back();

    }

    public function delete($slider_id): \Illuminate\Http\RedirectResponse
    {
        $slider_info = ImageSetting::query()->findOrFail($slider_id);

        $old = $slider_info['image_src'];
        if (file_exists($old) and !is_dir($old)) {
            unlink($old);
        }

        $slider_info->delete();

        return back();
    }
}
