<?php

namespace App\Http\Controllers\user\orders;

use App\Helper\CalculateOrderPrice;
use App\Helper\GetCategoryTitle;
use App\Helper\GetGameAccountTitle;
use App\Helper\GetProductMainImage;
use App\Helper\GetProductTitleWithProId;
use App\Helper\GetUserAccountTitle;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\UserAccount;
use App\Models\UserAccountDetail;
use Illuminate\View\View;

class userOrderController extends Controller
{
    public function index(): View
    {
        $my_order_list = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->paginate();

        foreach ($my_order_list as $my_order) {
            $my_order['jalali_date'] = verta($my_order['created_at'])->format('j/%B/Y');
            $my_order['total_price'] = CalculateOrderPrice::calculate_order_price($my_order['id']);
        }

        return view('user.orders.index', compact('my_order_list'));
    }

    public function detail($order_id): View
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
            $item['game_account_title'] = GetUserAccountTitle::get_user_account_title($item['user_account_id']);

            $user_account = UserAccount::query()
                ->with('account')
                ->with('user_account_details.fieldInfo')
                ->where('account_id', $item['user_account_id'])
                ->orderBy('default', 'desc')
                ->first();

            $item['user_account_detail_info'] = UserAccountDetail::query()
                ->where('user_account_id', $user_account['id'])
                ->get();
        }

        $order_status_list = OrderStatus::query()
            ->get();

        return view('user.orders.order_details',compact('order_detail_infos', 'order_info', 'total_order_price', 'order_status_list'));
    }
}
