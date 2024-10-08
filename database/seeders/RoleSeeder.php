<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'ادمین کل',
                'role_class' => 'badge-success',
            ],
            [
                'role_name' => 'کاربر عادی',
                'role_class' => 'badge-warning',
            ],
            [
                'role_name' => 'ادمین معمولی',
                'role_class' => 'badge-primary',
            ],
            [
                'role_name' => 'کارشناس محتوا',
                'role_class' => 'badge-info',
            ],
        ]);
    }
}
