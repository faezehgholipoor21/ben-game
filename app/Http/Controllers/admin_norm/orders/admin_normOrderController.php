<?php

namespace App\Http\Controllers\admin_norm\orders;

use App\Helper\CalculateOrderPrice;
use App\Helper\GetCategoryTitle;
use App\Helper\GetGameAccountTitle;
use App\Helper\GetOrderStatusTitleCss;
use App\Helper\GetProductMainImage;
use App\Helper\GetProductTitleWithProId;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;

class admin_normOrderController extends Controller
{
    public function index()
    {
        $order_list = Order::query()
            ->paginate();

        foreach ($order_list as $order) {
            $order['jalali_date'] = verta($order['created_at'])->format('j/%B/Y');
            $order['total_price'] = CalculateOrderPrice::calculate_order_price($order['id']);
            $order_status = GetOrderStatusTitleCss::get_order_status_title_css($order['id']);
            $order['order_status_css'] = $order_status[1];
            $order['order_status_title'] = $order_status[0];
        }

        return view('admin_norm.orders.index', compact('order_list'));
    }

    public function detail($order_id)
    {
        $order_info = Order::query()
            ->where('id', $order_id)
            ->first();

        $order_status = GetOrderStatusTitleCss::get_order_status_title_css($order_info['id']);
        $order_status_css = $order_status[1];
        $order_status_title = $order_status[0];
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

        return view('admin_norm.orders.order_details', compact('order_detail_infos', 'order_info', 'order_status_css', 'order_status_title', 'total_order_price', 'order_status_list'));

    }

    public function change_order_status(Request $request)
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

    public function order_allocation($order_id)
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
