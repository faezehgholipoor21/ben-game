<?php

namespace App\Http\Controllers\user\subscribes;

use App\Helper\ChangeDollar;
use App\Helper\zarrinpal\OrderZarrinpal;
use App\Helper\zarrinpal\SubscribeZarrinpal;
use App\Helper\zarrinpal\SubscribeZarrinpalVerify;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use App\Models\SubscribeHistoryUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserSubscribeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $subscribe_list = Subscribe::query()
            ->get();

        return view('user.subscribes.index', compact('subscribe_list'));
    }

    public function subscribe_pay($sub_id)
    {
        $subscribe_info = Subscribe::query()->find($sub_id);

        if ($subscribe_info) {
            $mobile = Auth::user()->mobile;
            $user_id = Auth::id();
            $amount = intval(ChangeDollar::change_dollar($subscribe_info['price']));
            $email = "";
            $description = "";

            $subscribe_history_user = $this->subscribe_history_init($user_id,$sub_id,$description,$amount);

            $call_back_url = route('user.update_sub_after_pay', ['sub_history_user_id' => $subscribe_history_user['id']]);

            $subscribe_zarrinpal = new SubscribeZarrinpal();
            $subscribe_zarrinpal->zarrinpal_request($call_back_url, $mobile, $amount, $email, $subscribe_history_user['id']);
        }
    }

    public function update_subscribe_after_pay(Request $request, $sub_history_user_id)
    {
//        Log::info(json_encode($request->all()));
//        Log::info($sub_id);

//        TODO we must change get price from subscribe user history
        $sub_history_info = SubscribeHistoryUser::query()->find($sub_history_user_id);

        $sub_info = Subscribe::query()->find($sub_history_info['subscribe_id']);

        if ($sub_info) {
            $is_exists = 1;
        } else {
            $is_exists = 0;
        }

        $view_name = "user.subscribes.final_view";
        $data = $sub_history_user_id;

        $amount = ChangeDollar::change_dollar($sub_info['price']);
        $authority = $request->get("Authority");

        $update_subscribe_after_pay = new SubscribeZarrinpalVerify();
        return $update_subscribe_after_pay->update_after_pay($request, $is_exists, $data, $amount, $authority, $view_name);
    }

    public function subscribe_history_init($user_id, $sub_id, $description, $price)
    {
        $subscribe_history_user = SubscribeHistoryUser::query()->create([
            'user_id' => $user_id,
            'subscribe_id' => $sub_id,
            'description' => $description,
            'price' => $price,
            'status' => 0,

        ]);
        return $subscribe_history_user;
    }

}
