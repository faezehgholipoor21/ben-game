<?php

namespace App\Http\Controllers\admin\images;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\ImageType;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;
use RealRashid\SweetAlert\Facades\Alert;

class adminImagesController extends Controller
{
    #[NoReturn] public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $images_info = Images::query()
            ->paginate(10);

        foreach ($images_info as $item) {
            $image_type_info = ImageType::query()
                ->where('id', $item['image_type_id'])
                ->first();

            $item['image_type_id'] = $image_type_info['image_type_name'];
        }

        return view('admin.images.image_name.index', compact('images_info',));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $images_info = Images::query()
            ->get();

        $image_type_info = ImageType::query()
            ->get();

        return view('admin.images.image_name.create', compact('images_info', 'image_type_info'));
    }

    #[NoReturn] public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'image_name' => 'required|max:1024',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $file = $request->file('image_name');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'image_name_' . time() . '.' . $file_ext;
        $image_name = $file->move('site\assets\image_name', $file_name);

        $image_type = ImageType::query()
            ->where('id', $input['image_type_id'])
            ->first();

        Images::query()->create([
            'image_name' => RepairFileSrc::repair_file_src($image_name),
            'image_type_id' => $image_type['id'],
        ]);

        alert()->success('', 'فیلد عکس با موفقیت افزوده شد.');
        return redirect()->route('admin.images_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $images_info = Images::query()->findOrFail($id);

        $image_type_info = ImageType::query()->get();

        return view('admin.images.image_name.edit', compact('images_info', 'image_type_info'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $images_info = Images::query()->findOrFail($id);

        $image_type_info = ImageType::query()
            ->where('id', $input['image_type_id'])
            ->first();

        $images_info->update([
            'image_name' => RepairFileSrc::repair_file_src('image_name'),
            'image_type_id' => $image_type_info['id']
        ]);

        $validation = Validator::make($input, [
            'image_name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        alert()->success('', 'فیلد عکس با موفقیت ویرایش شد.');
        return redirect()->route('admin.images_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $images_info = Images::query()->findOrFail($id);
        $images_info->delete();

        alert()->success('', 'فیلد عکس با موفقیت حذف شد.');
        return back();
    }

    public function activate(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();

        $image_info = Images::query()
            ->where('id', $input['image_id'])
            ->first();

        if ($image_info['is_main'] == 0) {
            $image_info->update([
                'is_main' => 1,
                'image_css' => 'btn btn-success',
                'css_title' => 'الویت نمایش',
            ]);
            return response()->json(
                [
                    'error' => false,
                    'message' => 'الویت به این تصویر اختصاص یافت',
                ]
            );
        } else {
            $image_info->update([
                'is_main' => 0,
                'image_css' => 'btn btn-info',
                'css_title' => 'معمولی',
            ]);

            return response()->json(
                [
                    'error' => false,
                    'message' => 'الویت از این تصویر گرفته شد',
                ]
            );
        }

    }

}
