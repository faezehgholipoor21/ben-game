<?php

namespace App\Http\Controllers\admin\faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\CategoryFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminCategoryFaqController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $faq_category_info = CategoryFaq::query()
            ->paginate(10);

        return view('admin.faq.category_faq.index', compact('faq_category_info'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $faq_category_info = CategoryFaq::query()
            ->get();

        return view('admin.faq.category_faq.create', compact('faq_category_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'faq_title' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        CategoryFaq::query()->create([
            'faq_title' => $input['faq_title'],
        ]);

        alert()->success('', 'دسته بندی سوالات متدوال با موفقیت افزوده شد.');
        return redirect()->route('admin.faq_category_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $faq_category = CategoryFaq::query()->findOrFail($id);
        return view('admin.faq.category_faq.edit', compact('faq_category'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $faq_category_info = CategoryFaq::query()->findOrFail($id);

        $input = $request->all();

        $validation = Validator::make($input, [
            'faq_title' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $faq_category_info->update([
            'faq_title' => $input['faq_title'],
        ]);

        alert()->success('', 'اکانت با موفقیت ویرایش شد.');
        return redirect()->route('admin.faq_category_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $faq_cat_count_info = CategoryFaq::query()->findOrFail($id);

        $faq_count_info = Faq::query()
            ->where('cat_id', $id)
            ->count();

        if ($faq_count_info == 0) {
            $faq_cat_count_info->delete();
            alert()->success('', 'دسته بندی سوال با موفقیت حذف شد.');
            return back();
        } else {
            alert()->success('', 'شما برای این دسته بندی زیرمجموعه تعریف کرده اید لطفا ابتدا آن را حذف نمایید.');
            return back();
        }

    }
}
