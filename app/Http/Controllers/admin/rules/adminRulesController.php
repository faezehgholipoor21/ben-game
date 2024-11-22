<?php

namespace App\Http\Controllers\admin\rules;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminRulesController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $rule_info = Rules::query()
            ->paginate(10);

        return view('admin.rules.index', compact('rule_info',));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $rule_info = Rules::query()
            ->get();

        return view('admin.rules.create', compact('rule_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'image_src' => 'required|max:1024',
            'title' => 'required|string|max:255',
            'topic' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $file = $request->file('image_src');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'image_src_' . time() . '.' . $file_ext;
        $image_src = $file->move('site\assets\image_src', $file_name);

        Rules::query()->create([
            'image_src' => RepairFileSrc::repair_file_src($image_src),
            'title' => $input['title'],
            'topic' => $input['topic'],
            'description' => $input['description'],
        ]);

        alert()->success('', 'قانون جدید با موفقیت افزوده شد.');
        return redirect()->route('admin.rule_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $rule_info = Rules::query()->findOrFail($id);

        return view('admin.rules.edit', compact('rule_info'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $rule_info = Rules::query()->findOrFail($id);

        if ($request->has('image_src')) {

            //get posts image and delete old profile
            $old = $rule_info->image_src;

            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('image_src');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'rule_' . time() . '.' . $file_ext;
            $rule_image = $file->move('site\assets\rules', $file_name);

            $rule_info->update([
                'image_src' => RepairFileSrc::repair_file_src($rule_image),
            ]);
        }

        $rule_info->update([
            'title' => $input['title'],
            'topic' => $input['topic'],
            'description' => $input['description'],
        ]);

        alert()->success('', 'قانون با موفقیت ویرایش شد.');
        return redirect()->route('admin.rule_panel');
    }

    public function delete($id): \Illuminate\Http\RedirectResponse
    {
        $rule_info = Rules::query()->findOrFail($id);

        $image_info = Rules::query()
            ->get();


         $old = $rule_info['image_src'];
            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

//        foreach ($image_info as $item) {
//            $old = $item['image_src'];
//            if (file_exists($old) and !is_dir($old)) {
//                unlink($old);
//            }
//        }

        $rule_info->delete();

        alert()->success('', ' قانون با موفقیت حذف شد.');
        return back();
    }
}
