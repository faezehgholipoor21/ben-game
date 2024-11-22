<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
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
                'title' => 'در انتظار پرداخت',
                'order_class' => 'badge-info',
            ],
            [
                'title' => 'پرداخت شده',
                'order_class' => 'badge-danger',
            ],
        ]);
    }
}
