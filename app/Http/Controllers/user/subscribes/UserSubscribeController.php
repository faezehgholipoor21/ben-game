<?php

namespace App\Http\Controllers\user\subscribes;

use App\Helper\ChangeDollar;
use App\Helper\zarrinpal\OrderZarrinpal;
use App\Helper\zarrinpal\SubscribeZarrinpal;
use App\Helper\zarrinpal\SubscribeZarrinpalVerify;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserSubscribeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
            $subscribe_list = Subscribe::query()
            ->get();

        return view('user.subscribes.index',compact('subscribe_list'));
    }

    public function subscribe_pay($sub_id)
    {
        $subscribe_info = Subscribe::query()->find($sub_id);

        if ($subscribe_info)
        {
            $mobile = Auth::user()->mobile;

            $call_back_url = route('user.update_sub_after_pay', ['sub_id' => $sub_id]);

            $amount = intval(ChangeDollar::change_dollar($subscribe_info['price']));

            $email = "" ;

            $subscribe_zarrinpal = new SubscribeZarrinpal();
            $subscribe_zarrinpal->zarrinpal_request($call_back_url,$mobile,$amount,$email,$sub_id);
        }
    }

    public function update_subscribe_after_pay(Request $request , $sub_id)
    {
        Log::info(json_encode($request->all()));
//        $update_subscribe_after_pay = new SubscribeZarrinpalVerify();
//        $update_subscribe_after_pay->update_order_after_pay();
    }

}
