<?php

namespace App\Http\Controllers\admin\faq;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\CategoryFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminFaqController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $faq_info = Faq::query()
            ->paginate(10);

        foreach ($faq_info as $item) {
            $faq_category_info = CategoryFaq::query()
                ->where('id', $item['cat_id'])
                ->first();

            $item['cat_id'] = $faq_category_info['faq_title'];
        }

        return view('admin.faq.index', compact('faq_info',));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $faq_info = Faq::query()
            ->get();

        $faq_category_info = CategoryFaq::query()
            ->get();

        return view('admin.faq.create', compact('faq_info', 'faq_category_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $faq_category_info = CategoryFaq::query()
            ->where('id', $input['cat_id'])
            ->first();

        Faq::query()->create([
            'question' => $input['question'],
            'answer' => $input['answer'],
            'cat_id' => $faq_category_info['id'],
        ]);

        alert()->success('', 'عنوان فیلد با موفقیت افزوده شد.');
        return redirect()->route('admin.faq_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $faq_info = Faq::query()->findOrFail($id);

        $faq_category_info = CategoryFaq::query()->get();

        return view('admin.faq.edit', compact('faq_info', 'faq_category_info'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $faq_info = Faq::query()->findOrFail($id);

        $faq_category_info = CategoryFaq::query()
            ->where('id', $input['cat_id'])
            ->first();

        $faq_info->update([
            'question' => $input['question'],
            'answer' => $input['answer'],
            'cat_id' => $faq_category_info['id']
        ]);

        $validation = Validator::make($input, [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        alert()->success('', 'فیلد اکانت با موفقیت ویرایش شد.');
        return redirect()->route('admin.faq_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $faq_info = Faq::query()->findOrFail($id);
        $faq_info->delete();

        alert()->success('', ' سوال با موفقیت حذف شد.');
        return back();
    }

}
