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
                'order_class' => 'badge-info',
            ],
            [
                'title' => 'تکمیل شده',
                'order_class' => 'badge-info',
            ],
            [
                'title' => 'اطلاعات اشتباه',
                'order_class' => 'badge-danger',
            ],
            [
                'title' => 'عدم پاسخ',
                'order_class' => 'badge-danger',
            ],
            [
                'title' => 'نیاز به احراز هویت',
                'order_class' => 'badge-danger',
            ],
            [
                'title' => 'مغایرت محصول یا موجود نبودن',
                'order_class' => 'badge-danger',
            ],
            [
                'title' => 'در حال استرداد مبلغ',
                'order_class' => 'badge-danger',
            ],
            [
                'title' => 'مسترد شده',
                'order_class' => 'badge-danger',
            ],
        ]);
    }
}
