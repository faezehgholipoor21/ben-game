<?php

namespace App\Http\Controllers\admin\about_us;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminAboutUsController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $about_info = AboutUs::query()
            ->first();

        return view('admin.about_us.index', compact('about_info'));
    }

    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $about_info = AboutUs::query()
            ->where('id',1)
            ->first();

        $validation = Validator::make($input, [
            'title' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,jpeg|max:1024',
            'description' => 'required|string',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        if ($request->has('image')) {
            //get posts image and delete old profile
            $old = $about_info->image;

            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'about_' . time() . '.' . $file_ext;
            $about_image = $file->move('site\assets\about_images', $file_name);

            $about_info->update([
                'image' => RepairFileSrc::repair_file_src($about_image),
            ]);
        }

        $about_info->update([
            'title' => $input['title'],
            'description' => $input['description'],
        ]);

        alert()->success('','درباره ما با موفقیت ویرایش شد');
        return back();
    }
}
