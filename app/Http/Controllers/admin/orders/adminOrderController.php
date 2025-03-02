<?php

namespace App\Http\Controllers\admin\orders;

use App\Helper\CalculateOrderPrice;
use App\Helper\GetCategoryTitle;
use App\Helper\GetProductMainImage;
use App\Helper\GetProductTitleWithProId;
use App\Helper\GetUserAccountTitle;
use App\Helper\GetUserRoleNameByUserId;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\OrderStatusReport;
use App\Models\Product;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\UserAccountDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->latest()
            ->paginate();

        foreach ($orders as $order) {
            $order['jalali_date'] = verta($order['created_at'])->format('%d %B %Y');
        }

        $order_status = OrderStatus::query()
            ->get();

        $searched = false;

        return view('admin.orders.index', compact('orders', 'order_status', 'searched'));
    }

    function search(Request $request): \Illuminate\Contracts\View\Factory|View|\Illuminate\Contracts\Foundation\Application
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

        $orders = Order::query()
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

        foreach ($orders as $order) {
            $order['jalali_date'] = verta($order['created_at'])->format('%d %B %Y');
        }

        $order_status = OrderStatus::query()
            ->get();

        $searched = true;
        return view('admin.orders.index', compact('orders', 'searched', 'order_status', 'order_number', 'mobile','order_status_s'));
    }

    public function separate_orders($order_status_id): \Illuminate\Contracts\View\Factory|View|\Illuminate\Contracts\Foundation\Application
    {

        $my_order_list = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->where('order_status', $order_status_id)
            ->latest()
            ->paginate();

        foreach ($my_order_list as $my_order) {
            $my_order['jalali_date'] = verta($my_order['created_at'])->format('j/%B/Y');
            $my_order['total_price'] = CalculateOrderPrice::calculate_order_price($my_order['id']);
        }

        $order_status = OrderStatus::query()
            ->get();

        $searched = false;

        return view('admin.orders.separate_orders', compact('my_order_list', 'searched','order_status','order_status_id'));
    }

    function separate_order_search(Request $request , $order_status_id): \Illuminate\Contracts\View\Factory|View|\Illuminate\Contracts\Foundation\Application
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

        $my_order_list = Order::query()
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
            ->where('orders.order_status', $order_status_s)
            ->paginate();

        foreach ($my_order_list as $my_order) {
            $my_order['jalali_date'] = verta($my_order['created_at'])->format('%d %B %Y');
            $my_order['total_price'] = CalculateOrderPrice::calculate_order_price($my_order['id']);
        }

        $order_status = OrderStatus::query()
            ->get();

        $searched = true;
        return view('admin.orders.separate_orders', compact('my_order_list', 'searched','order_status_id', 'order_status', 'order_number', 'mobile','order_status_s'));
    }
    public function detail($order_id): View
    {
        $order_info = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->where('id', $order_id)
            ->first();

        $jalali_date_order = verta($order_info['created_at'])->format('%d %B %Y');

        $expert_list = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('role_user.role_id', 3);
        })->get();

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

        $order_status_report = OrderStatusReport::query()
            ->where('order_id', $order_id)
            ->get();

        foreach ($order_status_report as $report) {
            $report['jalali_date'] = verta($report['created_at'])->format('%d %B %Y');
        }

        $order_status_list = OrderStatus::query()
            ->get();

        return view('admin.orders.detail', compact('order_info', 'order_status_report', 'expert_list', 'jalali_date_order', 'order_status_list', 'total_order_price', 'order_detail_infos'));
    }

    public function change_order_status(Request $request): RedirectResponse
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
        return redirect()->route('admin.orders');
    }

    public function order_allocation($order_id): RedirectResponse
    {
        $user_id = auth()->user()->id;

        $order_info = Order::query()
            ->where('id', $order_id)
            ->firstOrFail();

        $order_info->update([
            'review_expert_id' => $user_id
        ]);

        alert()->success('', 'این سفارش به شما اختصاص داده شد');
        return redirect()->route('admin.orders');
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

    public function update_review_expert(Request $request)
    {
        $input = $request->all();

        $order_id = $input['order_id'];
        $expert_id = $input['review_expert_id'];

        // پیدا کردن سفارش بر اساس ID
        $order = Order::find($order_id);

        if ($order) {
            // به‌روزرسانی review_expert_id
            $order->update(['review_expert_id' => $expert_id]);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'سفارش پیدا نشد']);
        }
    }

}
