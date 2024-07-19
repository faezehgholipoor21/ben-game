<?php

namespace App\Http\Controllers\admin\top_banners;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\ImageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminTopBannerController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $top_banner_info = ImageSetting::query()
            ->where('image_id', 4)
            ->paginate();

        return view('admin.top_banners.index', compact('top_banner_info'));
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
        $file_name = 'top_banner_' . time() . '.' . $file_ext;
        $top_banner_image = $file->move('site\assets\top_banners', $file_name);

        ImageSetting::query()->create([
            'image_id' => 4,
            'image_src' => RepairFileSrc::repair_file_src($top_banner_image),
            'is_main' => 0,
            'image_css' => 'btn btn-primary text-white'
        ]);

        alert()->success('', 'عکس جدید با موفقیت افزوده شد.');
        return back();

    }

    public function delete($top_banner_id): \Illuminate\Http\RedirectResponse
    {
        $top_banner_info = ImageSetting::query()->findOrFail($top_banner_id);

        $old = $top_banner_info['image_src'];
        if (file_exists($old) and !is_dir($old)) {
            unlink($old);
        }

        $top_banner_info->delete();

        return back();
    }

    function show_banner(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();

        $image_setting_info=ImageSetting::query()
            ->where('id',$input['top_banner_id'])
            ->first();

        $image_setting_info_count=ImageSetting::query()
            ->where('image_id',4)
            ->where('is_main',1)
            ->count();

        if ($image_setting_info_count<=1){

            if($image_setting_info['is_main'] == 0){
                $image_setting_info->update([
                    'is_main' => 1,
                    'image_css' => 'btn btn-success text-white'
                ]);
                return response()->json(
                    [
                        'status' => true
                    ]
                );
            }
            else{
                $image_setting_info->update([
                    'is_main' => 0,
                    'image_css' => 'btn btn-primary text-white'
                ]);
                return response()->json(
                    [
                        'status' => true
                    ]
                );
            }
        }
        else{
            return response()->json(
                [
                    'status' => false,
                    'message' => 'شما 2 تصویر فعال دارید',
                ]
            );
        }

    }

    public function deactive_banners(Request $request)
    {
        $input = $request->all();

        $image_setting_info=ImageSetting::query()
            ->where('image_id',4)
            ->where('is_main',1)
            ->get();

        foreach ($image_setting_info as $item){
            $item->update([
                'is_main' => 0,
                'image_css' => 'btn btn-primary text-white'
            ]);
        }

        return response()->json(
            [
                'status' => true,
                'message' => 'تصاویر غیرفعال شد',
            ]
        );

    }
}
