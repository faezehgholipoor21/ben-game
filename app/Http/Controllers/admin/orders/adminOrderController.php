<?php

namespace App\Http\Controllers\admin\orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class adminOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->with(['expertInfo', 'userInfo', 'statusInfo'])
            ->paginate();

        foreach ($orders as $order) {
            $order['jalali_date'] = verta($order['created_at'])->format('%d %B %Y');
        }

        $searched = false;

        return view('admin.orders.index', compact('orders', 'searched'));
    }

    public function detail($order_id): View
    {
        $order_info = Order::query()
            ->with([
                'expertInfo',
                'userInfo',
                'statusInfo',
                'orderDetail.product' => function ($query) {
                    $query->with([
                        'categoryInfo',
                        'accountInfo.fieldInfo',
                    ]);
                }
            ])
            ->where('id', $order_id)
            ->first();

        $order_info['jalali_date'] = verta($order_info['created_at'])->format('%d %B %Y');

        $order_status_list = OrderStatus::query()->get();

        return view('admin.orders.detail', compact('order_info', 'order_status_list'));
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
}
