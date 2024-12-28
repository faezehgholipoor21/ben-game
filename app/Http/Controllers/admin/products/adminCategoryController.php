<?php

namespace App\Http\Controllers\admin\products;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminCategoryController extends Controller
{
    public function index(): Factory|View|Application
    {
        $category_product_info = Category::query()
            ->where('id' , '!=' , 1)
            ->paginate(10);

        return view('admin.products.category.index', compact('category_product_info'));
    }

    public function create(): Factory|View|Application
    {
        $category_info = Category::query()
            ->paginate(10);

        return view('admin.products.category.create',compact('category_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = validator::make($input, [
            'cat_title' => 'required',
            'cat_slug' => 'required',
            'cat_image' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors());
        }

        $category_info = Category::query()->create([
            'cat_title' => $input['cat_title'],
            'cat_meta_description' => $input['cat_meta_description'],
            'cat_slug' => str_replace(' ', '-', $input['cat_slug']),
            'cat_meta_keywords' => $input['cat_meta_keywords'],
            'cat_content' => $input['cat_content'],
            'parent' => $input['parent'],
        ]);

        $file = $request->file('cat_image');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'product_' . time() . '.' . $file_ext;
        $cat_image = $file->move('site\assets\products', $file_name);

        $category_info->update([
           'cat_image' => RepairFileSrc::repair_file_src($cat_image),
        ]);

        alert()->success('', 'دسته جدید با موفقیت افزوده شد.');
        return redirect()->route('admin.category_product_panel');
    }

    public function edit($id): Factory|View|Application
    {
        $category_product_edit = Category::query()->findOrFail($id);

        $category_info = Category::query()
            ->paginate(10);

        return view('admin.products.category.edit', compact('category_product_edit','category_info'));
    }

    public function update(Request $request,$id): RedirectResponse
    {
        $category_product_info = Category::query()->findOrFail($id);

        $input = $request->all();
        $validation = Validator::make($input, [
            'cat_title' => 'required|string|max:255',
            'cat_slug' => 'required|string|max:255'
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        if ($request->has('cat_image')) {
            //get posts image and delete old profile
            $old = $category_product_info->cat_image;

            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('cat_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'product_' . time() . '.' . $file_ext;
            $cat_image = $file->move('site\assets\products', $file_name);

            $category_product_info->update([
                'cat_image' => RepairFileSrc::repair_file_src($cat_image),
            ]);
        }

        $category_product_info->update([
            'cat_title' => $input['cat_title'],
            'cat_meta_description' => $input['cat_meta_description'],
            'cat_slug' => str_replace(' ', '-', $input['cat_slug']),
            'cat_meta_keywords' => $input['cat_meta_keywords'],
            'cat_content' => $input['cat_content'],
            'parent' => $input['parent'],
        ]);

        alert()->success('', 'دسته بندی با موفقیت ویرایش شد.');
        return redirect()->route('admin.category_product_panel');
    }

    public function delete($id): RedirectResponse
    {
        $category_info = Category::query()->findOrFail($id);

        $product_count = Product::query()
            ->where('cat_id' , $id)
            ->count();

        if ($product_count == 0)
        {
            $category_info->delete();
            alert()->success('', 'دسته بندی با موفقیت حذف شد.');
        }
        else{
            alert()->success('', 'شما برای این دسته بندی زیرمجموعه تعریف کرده اید لطفا ابتدا آن را حذف نمایید.');
        }
        return redirect()->route('admin.category_product_panel');

    }
}
