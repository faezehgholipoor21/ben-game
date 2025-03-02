<?php

namespace App\Http\Controllers\admin_norm\orders;

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
use App\Models\OrderStatusReport;
use App\Models\Product;
use App\Models\UserAccount;
use App\Models\UserAccountDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class admin_normOrderController extends Controller
{
    public function index(): View
    {
        $order_list = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->latest()
            ->paginate();

        foreach ($order_list as $order) {
            $order['jalali_date'] = verta($order['created_at'])->format('%d %B %Y');
        }

        $order_status = OrderStatus::query()
            ->get();

        $searched = false;
        return view('admin_norm.orders.index', compact('order_list' , 'order_status','searched'));
    }

    public function search(Request $request): View
    {
        $input = $request->all();

        if ($request->has('order_number') and $input['order_number'] != '') {
            $order_number = $input['order_number'];
        } else {
            $order_number = '';
        }

        if ($request->has('status') and $input['status'] != '') {
            $order_status_s = $input['status'];
        } else {
            $order_status_s = '';
        }

        if ($request->has('mobile') and $input['mobile'] != '') {
            $mobile = $input['mobile'];
        } else {
            $mobile = '';
        }

        $order_list = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->select('*','orders.id as order_id', 'orders.order_status as order_status', 'orders.order_code', 'users.mobile as user_mobile')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->when($mobile, function ($query, $mobile) {
                return $query->where('users.mobile', 'like', "%{$mobile}%");
            })
            ->when($order_number, function ($query, $order_number) {
                return $query->where('orders.order_code', 'like', "%{$order_number}%");
            })
            ->when($order_status_s, function ($query, $order_status_s) {
                return $query->where('orders.order_status', 'like', "%{$order_status_s}%");
            })
            ->paginate();

        foreach ($order_list as $order) {
            $order['jalali_date'] = verta($order['created_at'])->format('%d %B %Y');
        }

        $order_status = OrderStatus::query()
            ->get();

        $searched = true;

        return view('admin_norm.orders.index', compact('order_list' , 'order_status','searched'));
    }

    public function my_orders($order_status): View
    {
        $my_order_list = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->where('review_expert_id', auth()->user()->id)
            ->where('order_status', $order_status)
            ->latest()
            ->paginate();

        foreach ($my_order_list as $my_order) {
            $my_order['jalali_date'] = verta($my_order['created_at'])->format('j/%B/Y');
            $my_order['total_price'] = CalculateOrderPrice::calculate_order_price($my_order['id']);
        }

        return view('admin_norm.orders.my_orders', compact('my_order_list'));
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
//
//            foreach ($item['user_account_detail_info'] as $value) {
//                dd($value['fieldInfo']);
//            }
        }

        $order_status_list = OrderStatus::query()
            ->get();

        $order_status_report = OrderStatusReport::query()
            ->where('order_id', $order_id)
            ->get();

        return view('admin_norm.orders.order_details', compact('order_detail_infos','order_status_report', 'order_info', 'total_order_price', 'order_status_list'));
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

        if ($input['order_status_report'] != null) {
            OrderStatusReport::query()->create([
                'order_id' => $order_info['id'],
                'author' => Auth::user()->id,
                'report_text' => $input['order_status_report'],
                'read' => 0
            ]);
        }

        alert()->success('', 'وضعیت سفارش شما تغییر کرد');
        return redirect()->route('admin_norm.orders');

    }

    public function order_allocation($order_id): \Illuminate\Http\RedirectResponse
    {
        $user_id = auth()->user()->id;

        $order_info = Order::query()
            ->where('id', $order_id)
            ->first();

        $order_info->update([
            'review_expert_id' => $user_id
        ]);

        alert()->success('', 'این سفارش به شما اختصاص داده شد');
        return redirect()->route('admin_norm.orders');


    }

    public function change_order_status_report(Request $request)
    {
        $input = $request->all();

        $order_status_report = OrderStatusReport::query()
            ->where('id', $input['order_status_report_id'])
            ->firstOrFail();

        if ($order_status_report['read'] == 0) {
            $order_status_report->update([
                'read' => 1
            ]);

        }
        return response()->json([
            'error' => false,
            'message' => 'وضعیت گزارش به روز شد',
        ]);
    }

}
