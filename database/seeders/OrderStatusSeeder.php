<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert([
            [
                'title' => 'در حال بررسی',
                'order_class' => 'new_under_review',
            ],
            [
                'title' => 'تکمیل شده',
                'order_class' => 'far fa-check-circle',
            ],
            [
                'title' => 'اطلاعات اشتباه',
                'order_class' => 'badge badge-danger',
            ],
            [
                'title' => 'عدم پاسخ',
                'order_class' => 'no_response',
            ],
            [
                'title' => 'نیاز به احراز هویت',
                'order_class' => 'badge badge-primary',
            ],
            [
                'title' => 'مغایرت محصول یا موجود نبودن',
                'order_class' => 'not_available',
            ],
            [
                'title' => 'در حال استرداد مبلغ',
                'order_class' => 'refunding_the_amount',
            ],
            [
                'title' => 'مسترد شده',
                'order_class' => 'refunded',
            ],
        ]);
    }
}
