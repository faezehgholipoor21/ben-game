<?php

namespace App\Http\Controllers\admin\products;

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
            ->paginate(10);

        return view('admin.products.category.index', compact('category_product_info'));
    }

    public function create(): Factory|View|Application
    {

        $category_info = Category::query()
            ->paginate(10);

        return view('admin.products.category.create',compact('category_info'));
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'cat_title' => 'required|string|max:255',
            'cat_slug' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

       $categories= Category::create([
            'cat_title' => $input['cat_title'],
            'cat_slug' => $input['cat_slug'],
        ]);

        alert()->success('', 'دسته بندی با موفقیت افزوده شد.');
        return redirect()->route('admin.category_product_panel',compact('categories'));
    }

    public function edit($id): Factory|View|Application
    {
        $category_product_edit = Category::query()->findOrFail($id);

        return view('admin.products.category.edit', compact('category_product_edit'));
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

        $category_product_info->update([
            'cat_title' => $input['cat_title'],
            'cat_slug' => $input['cat_slug']
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
