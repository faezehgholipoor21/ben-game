<?php

namespace App\Http\Controllers\admin\inquiry;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class adminInquiryController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $inquiry_info=Inquiry::query()
            ->latest('inquiry.created_at')
            ->paginate();

        foreach ($inquiry_info as $item){
            $user_info=User::query()
                ->where('id',$item['user_id'])
                ->first();

            $item['user_name'] = $user_info['first_name'] . ' ' .$user_info['last_name'];
            $item['mobile'] = $user_info['mobile'];

            $product_info=Product::query()
                ->where('id',$item['product_id'])
                ->first();

            $item['product_name']=$product_info['product_title'];
        }
        return view('admin.inquiry.index',compact('inquiry_info'));
    }

    public function update($inquiry_id): \Illuminate\Http\RedirectResponse
    {
        $inquiry_info = Inquiry::query()
            ->where('id',$inquiry_id)
            ->first();

        $inquiry_info->update([
            'status'=>1,
            'css_style'=>'btn btn-success'
        ]);

        alert()->success('','استعلام ملاحظه گردید');
        return redirect()->route('admin.inquiry_panel');
    }

    public function delete($inquiry_id): \Illuminate\Http\RedirectResponse
    {
        $inquiry_info = Inquiry::query()
            ->where('id',$inquiry_id)
            ->first();

        $inquiry_info->delete();

        alert()->success('','استعلام حذف  گردید');
        return redirect()->route('admin.inquiry_panel');
    }

    public function detail($inquiry_id): \Illuminate\Http\JsonResponse
    {
        $inquiry_info = Inquiry::query()
            ->where('id',$inquiry_id)
            ->first();

        return response()->json(
            [
                'status' => true,
                'phone' => $inquiry_info['phone'],
                'company_name' => $inquiry_info['company_name'],
                'description' => $inquiry_info['description'],
            ]
        );
    }
}
