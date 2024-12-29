<?php

namespace App\Http\Controllers\admin\products;

use App\Helper\GetCategoryTitle;
use App\Helper\GetGameAccountTitle;
use App\helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GameAccount;
use App\Models\GameAccountField;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminProductController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product_info = Product::query()
            ->paginate(10);

        foreach ($product_info as $item) {
            $item['cat_title'] = GetCategoryTitle::get_category_title($item['cat_id']);

        }
        return view('admin.products.index', compact('product_info'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category_info = Category::query()
            ->get();

        $game_account_info = GameAccount::query()
            ->get();

        return view('admin.products.create', compact('category_info'
            , 'game_account_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $input = $request->all();

        $validation = validator::make($input, [
            'product_name' => 'required',
            'product_nickname' => 'required|unique:products,product_nickname',
            'product_image' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
            'product_price' => 'required',
            'inventory' => 'required',
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors());
        }

        $price = str_replace(",", "", $input['product_price']);
        $force_price = str_replace(",", "", $input['product_force_price']);


        $product_info = Product::query()->create([
            'product_name' => $input['product_name'],
            'product_nickname' => str_replace(' ', '-', $input['product_nickname']),
            'product_price' => $price,
            'product_force_price' => $force_price,
            'inventory' =>  $input['inventory'],
            'cat_id' => $input['cat_id'],
        ]);

        $file = $request->file('product_image');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'product_' . time() . '.' . $file_ext;
        $product_image = $file->move('site\assets\products', $file_name);

        $product_info->update([
            'product_image' => RepairFileSrc::repair_file_src($product_image),
        ]);

        $product_info->accounts()->sync($input['game_account_ids']); // اتصال اکانت‌ها به محصول

        alert()->success('', 'محصول جدید با موفقیت افزوده شد.');
        return redirect()->route('admin.product_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product_info = Product::query()
            ->with('accounts')
            ->where('id', $id)
            ->first();
        $categories = Category::query()
            ->get();
        $all_accounts = GameAccount::query()
            ->get();
        return view('admin.products.edit', compact('product_info', 'categories', 'all_accounts'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $selectedAccounts = $input['game_account_ids'];

        $product_info = Product::query()
            ->where('id', $id)
            ->first();

        $price = str_replace(",", "", $input['product_price']);
        $force_price = str_replace(",", "", $input['product_force_price']);

        if ($request->has('product_image')) {
            //get posts image and delete old profile
            $old = $product_info->product_image;

            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('product_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'product_' . time() . '.' . $file_ext;
            $product_image = $file->move('site\assets\products', $file_name);

            $product_info->update([
                'product_image' => RepairFileSrc::repair_file_src($product_image),
            ]);
        }

        $product_info->update([
            'product_name' => $input['product_name'],
            'product_nickname' => str_replace(' ', '-', $input['product_nickname']),
            'product_price' => $price,
            'product_force_price' => $force_price,
            'inventory' =>  $input['inventory'],
        ]);

        // حذف اکانت‌های قبلی
        $product_info->accounts()->detach();

        // ذخیره اکانت‌های جدید
        if ($request->has('game_account_ids')) {
            $selectedAccounts = $request->input('game_account_ids');
            $product_info->accounts()->attach($selectedAccounts);
        }


        alert()->success('', 'محصول  با موفقیت ویرایش شد.');
        return redirect()->route('admin.product_panel');
    }

    public function delete($product_id): \Illuminate\Http\RedirectResponse
    {
        $product_info = Product::query()->findOrFail($product_id);
        // حذف اکانت‌های مرتبط با محصول
        $product_info->accounts()->detach();

        $product_info->delete();

        return back();
    }
}

