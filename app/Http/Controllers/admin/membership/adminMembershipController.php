<?php

namespace App\Http\Controllers\admin\membership;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Jobs\membership_level_job;
use App\Models\MembershipLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminMembershipController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $membership_list = MembershipLevel::query()
            ->paginate();

        return view('admin.membership.levels.index', compact('membership_list'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.membership.levels.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $validation = Validator::make($input, [
            'name' => 'required',
            'key' => 'required',
            'require_point' => 'required',
            'description' => 'required',
            'discount' => 'required',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }


        MembershipLevel::query()->create([
            'key' => $input['key'],
            'name' => $input['name'],
            'discount' => $input['discount'],
            'description' => $input['description'],
            'require_point' => $input['require_point'],
        ]);

        alert()->success('', 'سطح جدید با موفقیت افزوده شد.');
        return redirect()->route('admin.membership');
    }

    public function edit($member_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $member_info = MembershipLevel::query()->find($member_id);
        return view('admin.membership.levels.edit', compact('member_info'));
    }

    public function update(Request $request, $member_id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $membership = MembershipLevel::query()
            ->where('id', $member_id)
            ->findOrFail($member_id);


        $validation = Validator::make($input, [
            'name' => 'required',
            'key' => 'required',
            'require_point' => 'required',
            'description' => 'required',
            'discount' => 'required',
        ]);

        if ($validation->fails()) {
            alert()->error($validation->errors()->first(), 'خطا !');
            return back()->withErrors($validation->errors())->withInput();
        }

        $membership->update([
            'key' => $input['key'],
            'name' => $input['name'],
            'discount' => $input['discount'],
            'description' => $input['description'],
            'require_point' => $input['require_point'],
        ]);

        alert()->success('','سطح با موفقیت ویرایش شد');
        return redirect()->route('admin.membership');
    }

    public function destroy($member_id): \Illuminate\Http\RedirectResponse
    {
        $member_info = MembershipLevel::query()->find($member_id);

        $member_info->delete();

        alert()->success('', ' سطح با موفقیت حذف شد.');
        return back();
    }

    public function test()
    {
        $this->dispatch(new membership_level_job());
    }


}
