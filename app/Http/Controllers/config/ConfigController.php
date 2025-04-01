<?php

namespace App\Http\Controllers\config;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function tax(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $config_tax = Config::query()
            ->where('key', 'tax')
            ->first();

        return view('admin.config.tax', compact('config_tax'));
    }

    public function tax_update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $config_tax_info = Config::query()
            ->where('key', 'tax')
            ->first();

        $config_tax_info->update([
            'value' => $input['tax']
        ]);

        alert()->success('','مالیات با موفقیت ویرایش شد');
        return redirect()->route('admin.dashboard');
    }
}
