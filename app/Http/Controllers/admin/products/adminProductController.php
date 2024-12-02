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
            $image_product_info = ImageProduct::query()
                ->where('product_id', $item['id'])
                ->where('is_main', 1)
                ->where('image_id', 5)
                ->first();

            $item['cat_title'] = GetCategoryTitle::get_category_title($item['cat_id']);
            $item['image_src'] = $image_product_info['image_src'];
            $item['game_account'] = GetGameAccountTitle::get_game_account_title($item['game_account_id']);
        }

        return view('admin.products.index', compact('product_info'));
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $category_info = Category::query()
            ->get();

        $image_product_info = ImageProduct::query()
            ->where('is_main', 1)
            ->get();

        $game_account_info = GameAccount::query()
            ->get();

        return view('admin.products.create', compact('category_info'
            , 'image_product_info', 'game_account_info'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $input = $request->all();

        $validation = validator::make($input, [
            'product_name' => 'required',
            'product_nickname' => 'required|unique:products,product_nickname',
            'image_src' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
            'product_meta_description' => 'required',
            'product_meta_keywords' => 'required',
            'product_content' => 'required',
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
            'product_meta_description' => $input['product_meta_description'],
            'product_nickname' => str_replace(' ', '-', $input['product_nickname']),
            'product_meta_keywords' => $input['product_meta_keywords'],
            'product_content' => $input['product_content'],
            'product_price' => $price,
            'product_force_price' => $force_price,
            'inventory' =>  $input['inventory'],
            'cat_id' => $input['cat_id'],
            'game_account_id' => $input['account_name'],
        ]);


        $file = $request->file('image_src');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'product_' . time() . '.' . $file_ext;
        $product_image = $file->move('site\assets\products', $file_name);

        ImageProduct::query()->create([
            'image_src' => RepairFileSrc::repair_file_src($product_image),
            'product_id' => $product_info['id'],
            'image_id' => 5,
            'is_main' => 1,
        ]);

        alert()->success('', 'محصول جدید با موفقیت افزوده شد.');
        return redirect()->route('admin.product_panel');
    }

    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product_info = Product::query()
            ->where('id', $id)
            ->first();

        $image_product_info = ImageProduct::query()
            ->where('product_id', $product_info['id'])
            ->where('image_id', 5)
            ->where('is_main', 1)
            ->first();
        $product_info['product_image'] = $image_product_info['image_src'];

        $categories = Category::query()
            ->get();

        $game_account_id = GameAccount::query()
            ->get();

        return view('admin.products.edit', compact('product_info', 'categories', 'game_account_id'));
    }

    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $product_info = Product::query()
            ->where('id', $id)
            ->first();

        $game_account_info = GameAccount::query()
            ->where('id', $input['game_account_id'])
            ->get();

        $image_product_info = ImageProduct::query()
            ->where('product_id', $product_info['id'])
            ->where('image_id', 5)
            ->where('is_main', 1)
            ->first();

        if ($request->has('product_image')) {

            //get posts image and delete old profile
            $old = $image_product_info->image_src;
            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }

            $file = $request->file('product_image');
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'product_' . time() . '.' . $file_ext;
            $product_image = $file->move('site\assets\products', $file_name);

            $image_product_info->update([
                'image_src' => RepairFileSrc::repair_file_src($product_image),
            ]);
        }

        $price = str_replace(",", "", $input['product_price']);
        $force_price = str_replace(",", "", $input['product_force_price']);

        $product_info->update([
            'product_name' => $input['product_name'],
            'product_meta_description' => $input['product_meta_description'],
            'product_nickname' => str_replace(' ', '-', $input['product_nickname']),
            'product_meta_keywords' => $input['product_meta_keywords'],
            'product_content' => $input['product_content'],
            'product_price' => $price,
            'product_force_price' => $force_price,
            'inventory' =>  $input['inventory'],
        ]);

        alert()->success('', 'محصول  با موفقیت ویرایش شد.');
        return redirect()->route('admin.product_panel');
    }

    public function delete($product_id): \Illuminate\Http\RedirectResponse
    {
        $product_info = Product::query()->findOrFail($product_id);

        $image_product = ImageProduct::query()
            ->where('product_id', $product_id)
            ->get();

        foreach ($image_product as $item) {
            $old = $item['image_src'];
            if (file_exists($old) and !is_dir($old)) {
                unlink($old);
            }
        }

        $product_info->delete();

        return back();
    }
}

