<?php

namespace App\Http\Controllers\admin_norm\orders;

use App\Helper\CalculateOrderPrice;
use App\Helper\GetCategoryTitle;
use App\Helper\GetGameAccountTitle;
use App\Helper\GetProductMainImage;
use App\Helper\GetProductTitleWithProId;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class admin_normOrderController extends Controller
{
    public function index():View
    {
        $order_list = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->latest()
            ->paginate();

        foreach ($order_list as $order) {
            $order['jalali_date'] = verta($order['created_at'])->format('%d %B %Y');
        }
        return view('admin_norm.orders.index', compact('order_list'));
    }

    public function my_orders($order_status):View
    {
        $my_order_list = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->where('review_expert_id' , auth()->user()->id)
            ->where('order_status', $order_status)
            ->latest()
            ->paginate();

        foreach ($my_order_list as $my_order) {
            $my_order['jalali_date'] = verta($my_order['created_at'])->format('j/%B/Y');
            $my_order['total_price'] = CalculateOrderPrice::calculate_order_price($my_order['id']);
        }

        return view('admin_norm.orders.my_orders', compact('my_order_list'));
    }

    public function detail($order_id):View
    {
        $order_info = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->where('id', $order_id)
            ->first();

        $total_order_price = CalculateOrderPrice::calculate_order_price($order_info['id']);

        $order_detail_infos = OrderDetail::query()
            ->where('order_id', $order_id)
            ->get();

        foreach ($order_detail_infos as $item) {
            $product_info = Product::query()
                ->where('id', $item['product_id'])
                ->first();

            $item['product_name'] = GetProductTitleWithProId::get_product_title_with_pro_id($item['product_id']);
            $item['product_image'] = GetProductMainImage::get_product_main_image($item['product_id']);
            $item['product_cat_title'] = GetCategoryTitle::get_category_title($product_info['cat_id']);
            $item['game_account_title'] = GetGameAccountTitle::get_game_account_title($product_info['game_account_id']);
        }

        $order_status_list = OrderStatus::query()
            ->get();

        return view('admin_norm.orders.order_details', compact('order_detail_infos', 'order_info', 'total_order_price', 'order_status_list'));
    }

    public function change_order_status(Request $request): \Illuminate\Http\RedirectResponse
    {
        $input = $request->all();

        $order_info = Order::query()
            ->where('id', $input['order_id'])
            ->first();

        $order_info->update([
            'order_status' => $input['order_status']
        ]);

        alert()->success('', 'وضعیت سفارش شما تغییر کرد');
        return redirect()->route('admin_norm.orders');

    }

    public function order_allocation($order_id): \Illuminate\Http\RedirectResponse
    {
        $user_id = auth()->user()->id;

        $order_info = Order::query()
            ->where('id' , $order_id)
            ->first();

        $order_info->update([
            'review_expert_id' => $user_id
        ]);

        alert()->success('', 'این سفارش به شما اختصاص داده شد');
        return redirect()->route('admin_norm.orders');



    }
}
