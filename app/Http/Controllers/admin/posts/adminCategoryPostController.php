<?php

namespace App\Http\Controllers\admin\posts;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class adminCategoryPostController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category_post_info = CategoryPost::query()
            ->paginate(10);

        return view('admin.posts.category_post.index', compact('category_post_info'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $category_post_info = CategoryPost::query()
            ->get();

        return view('admin.posts.category_post.create', compact('category_post_info'));
    }

    #[NoReturn] public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'cat_post_title' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        CategoryPost::query()->create([
            'cat_post_title' => $input['cat_post_title'],
        ]);

        alert()->success('', 'دسته بندی مقالات با موفقیت افزوده شد.');
        return redirect()->route('admin.category_post.index');
    }

    public function show($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category_post_info = CategoryPost::query()->findOrFail($id);
        return view('admin.posts.category_post.show', compact('category_post_info'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $category_post_info = CategoryPost::query()
            ->where('id', $id)
            ->findOrFail($id);

        $validation = Validator::make($input, [
            'cat_post_title' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $category_post_info->update([
            'cat_post_title' => $input['cat_post_title'],
        ]);

        alert()->success('', 'دسته بندی مقالات با موفقیت ویرایش شد.');
        return redirect()->route('admin.category_post.index');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $category_post_info = CategoryPost::query()->findOrFail($id);

        $post_info = Post::query()
            ->where('cat_post_id', $id)
            ->count();

        if ($post_info == 0) {
            $category_post_info->delete();
            alert()->success('', 'دسته بندی مقالات با موفقیت حذف شد.');
            return back();
        } else {
            alert()->success('', 'شما برای این دسته بندی زیرمجموعه تعریف کرده اید لطفا ابتدا آن را حذف نمایید.');
            return back();
        }

    }
}
