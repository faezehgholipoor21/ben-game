<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_status')->insert([
            [
                'title' => 'در حال بررسی',
                'user_status_class' => 'badge badge-primary',
            ],
            [
                'title' => 'احراز شده',
                'user_status_class' => 'badge badge-success',
            ],
            [
                'title' => 'احراز نشده',
                'user_status_class' => 'badge badge-danger',
            ]
        ]);
    }
}
