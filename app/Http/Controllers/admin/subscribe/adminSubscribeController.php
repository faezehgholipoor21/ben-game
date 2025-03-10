<?php

namespace App\Http\Controllers\admin\subscribe;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Rules;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Monitoring\Subscriber;

class adminSubscribeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $subscribers = Subscribe::query()
            ->paginate();

        return view('admin.subscribe.index', compact('subscribers'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.subscribe.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'date' => 'required',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $file = $request->file('image');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'sub_image_' . time() . '.' . $file_ext;
        $sub_image = $file->move('site\assets\subscribe', $file_name);

        Subscribe::query()->create([
            'image' => RepairFileSrc::repair_file_src($sub_image),
            'name' => $input['name'],
            'price' => $input['price'],
            'date' => $input['date'],
            'discount' => $input['discount'],
            'description' => $input['description'],
        ]);

        alert()->success('', 'اشتراک جدید با موفقیت افزوده شد.');
        return redirect()->route('admin.subscribe');
    }




    public function edit($sub_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $subscriber = Subscribe::query()->find($sub_id);
        return view('admin.subscribe.edit', compact('subscriber'));
    }

    public function update(Request $request, $sub_id){}
    public function destroy($sub_id): \Illuminate\Http\RedirectResponse
    {
        $subscriber = Subscribe::query()->find($sub_id);

        $old = $subscriber['image'];
        if (file_exists($old) and !is_dir($old)) {
            unlink($old);
        }
        $subscriber->delete();

        alert()->success('', ' اشتراک با موفقیت حذف شد.');
        return back();
    }
}
