<?php

namespace App\Http\Controllers\admin\images;

use App\Helper\RepairFileSrc;
use App\Http\Controllers\Controller;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JetBrains\PhpStorm\NoReturn;

class adminProductImagesController extends Controller
{
    public function index($product_id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $product_info=Product::query()
            ->where('id',$product_id)
            ->first();

        $product_title=$product_info['product_title'];

        $product_image_info=ImageProduct::query()
            ->where('is_main',0)
            ->where('product_id',$product_id)
            ->paginate(10);

        return view('admin.products.product_images.index',compact('product_title','product_image_info','product_id'));
    }

    #[NoReturn] public function store(Request $request, $product_id): \Illuminate\Http\RedirectResponse
    {
        $input=$request->all();

        $validation = validator::make($input, [
            'image_src' => 'required|mimes:jpg,png,jpeg|max:1024', //1MB
        ]);

        if ($validation->fails()) {
            alert()->error('', $validation->errors()->first());
            return back()->withErrors($validation->errors());
        }

        $file = $request->file('image_src');
        $file_ext = $file->getClientOriginalExtension();
        $file_name = 'product_img_' . time() . '.' . $file_ext;
        $product_image = $file->move('site\assets\product_img', $file_name);

        ImageProduct::query()->create([
            'image_id'=>2,
            'image_src'=>RepairFileSrc::repair_file_src($product_image),
            'is_main'=>0,
            'product_id'=>$product_id

        ]);

        alert()->success('', 'عکس جدید با موفقیت افزوده شد.');
        return back();

    }

    public function delete($image_product_id): \Illuminate\Http\RedirectResponse
    {
        $image_product_info = ImageProduct::query()->findOrFail($image_product_id);

        $old = $image_product_info['image_src'];
        if (file_exists($old) and !is_dir($old)) {
            unlink($old);
        }

        $image_product_info->delete();

        return back();
    }
}
