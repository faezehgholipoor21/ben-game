<?php

namespace App\Http\Controllers\admin\images;

use App\Http\Controllers\Controller;
use App\Models\Images;
use App\Models\ImageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminImageTypeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $image_type_info = ImageType::query()
            ->paginate(10);

        return view('admin.images.image_type.index', compact('image_type_info'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $image_type_info = ImageType::query()
            ->get();

        return view('admin.images.image_type.create', compact('image_type_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'image_type_name' => 'required|string|max:255',
            'image_type_slug' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        ImageType::create([
            'image_type_name' => $input['image_type_name'],
            'image_type_slug' => $input['image_type_slug'],
        ]);

        alert()->success('', 'عنوان نوع جدید عکس با موفقیت افزوده شد.');
        return redirect()->route('admin.image_type_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $image_type_info = ImageType::query()->findOrFail($id);
        return view('admin.images.image_type.edit', compact('image_type_info'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $image_type_info = ImageType::query()->findOrFail($id);

        $input = $request->all();

        $validation = Validator::make($input, [
            'image_type_name' => 'required|string|max:255',
            'image_type_slug' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $image_type_info->update([
            'image_type_name' => $input['image_type_name'],
            'image_type_slug' => $input['image_type_slug'],
        ]);

        alert()->success('', 'نوع عکس با موفقیت ویرایش شد.');
        return redirect()->route('admin.image_type_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $image_type_info = ImageType::query()->findOrFail($id);

        $image_type_info_count = Images::query()
            ->where('image_type_id' , $id)
            ->count();

        if ($image_type_info_count == 0)
        {
            $image_type_info->delete();
            alert()->success('', 'عنوان اکانت با موفقیت حذف شد.');
            return back();
        }
        else{
            alert()->info('', 'شما برای این نوع عکس زیرمجموعه تعریف کرده اید لطفا ابتدا آن را حذف نمایید.');
            return back();
        }
    }
}
