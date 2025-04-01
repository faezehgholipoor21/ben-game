<?php

namespace App\Http\Controllers\user\wallet;

use App\Helper\WalletTypeTitle;
use App\Helper\zarrinpal\WalletZarrinpal;
use App\Helper\zarrinpal\WalletZarrinpalVerify;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserWalletController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $wallet_user = Wallet::query()
            ->where('user_id', Auth::id())
            ->first();

        $wallet_history_list = WalletHistory::query()
            ->whereHas('wallet', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        foreach ($wallet_history_list as $wallet_history) {
            $wallet_history['jalali_date'] = verta($wallet_history['created_at'])->format('%d %B %Y');
        }




        return view('user.wallet.index', compact('wallet_history_list', 'wallet_user'));
    }

    public function wallet_pay(Request $request)
    {
        $input = $request->all();

        $user_id = Auth::id();
        $mobile = Auth::user()->mobile;
        $amount = $input['amount'];
        $email = "";
        $data = $input['amount'];
        $gateway = 1 ;
        $description = "wallet payment";

        $call_back_url = route('user.update_wallet_after_pay', ['user_id' => $user_id]);


        $wallet_zarrinpal = new WalletZarrinpal();
        $wallet_zarrinpal->zarrinpal_request($call_back_url,$mobile,$amount,$email,$data,$gateway,$description);

    }

    public function update_wallet_after_pay(Request $request)
    {
//        Log::info(json_encode($request->all()));
//        Log::info($sub_id);

        $input = $request->all();

        $wallet_history_info = WalletHistory::query()
            ->where('authority' , $input['Authority'])
            ->first();



//        TODO we must change get price from subscribe user history

        $view_name = "user.wallet.final_view";
        $data = "";

        $amount = $wallet_history_info['amount'];
        $authority = $request->get("Authority");

        $update_wallet_after_pay = new WalletZarrinpalVerify();
        return $update_wallet_after_pay->update_after_pay($request, $data, $amount, $authority, $view_name);
    }
}
