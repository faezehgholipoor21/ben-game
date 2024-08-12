<?php

namespace App\Http\Controllers\site\rule;

use App\Http\Controllers\Controller;
use App\Models\Rules;

class ruleController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $rule_info = Rules::query()
            ->paginate(10);

        return view('site.rule.index',compact('rule_info'));
    }

    public function detail($rule_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $detail_info = Rules::query()
            ->where('id',$rule_id)
            ->first();

        return view('site.rule.detail',compact('detail_info'));
    }

}
