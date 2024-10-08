<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer(["admin.*"], function ($view) {
            $user_info = \App\Models\User::query()
                ->where('id', auth()->id())
                ->firstOrFail();

            //get profile image
//            $image_name = $user_info->image_name;
            $placeholder = asset('admin/assets/image_name/placeholders/user_placeholder.png');
//            $profile = $this->get_user_image($image_name, 'profile', $placeholder, false);
//            $user_info['profile'] = $profile;

            $view->with('user_info', $user_info);
        });

        View::composer(['*'], function ($view) {
            $category_info = Category::query()
                ->get();

            $view->with('category_info', $category_info);
        });

        View::composer(['*'], function ($view) {
            if (auth()->check()) {
                $user_info = User::query()
                    ->where('id', auth()->id())
                    ->firstOrFail();
            } else {
                $user_info = [];
            }

            $view->with('user_info', $user_info);
        });

        View::composer(['*'], function ($view) {
            if (auth()->check()) {
                $user_info = User::query()
                    ->where('id', auth()->id())
                    ->firstOrFail();
                $role_user_info = RoleUser::query()
                    ->where('user_id' , $user_info['id'])
                    ->first();

                $role_id = $role_user_info['role_id'];

            } else {
                $role_id = [];
            }

            $view->with('role_id', $role_id);
        });
    }

//    function get_user_image($image_name, $image_name, $placeholder, $withoutAsset)
//    {
//        $profile = $placeholder;
//        foreach ($image_name as $image) {
//            if ($image['image_name'] == $image_name) {
//                $profile = $image->pivot->image_src;
//                break;
//            }
//        }
//
//        if (file_exists($profile) and !is_dir($profile)) {
//            if ($withoutAsset) {
//                return $profile;
//            } else {
//                return asset($profile);
//            }
//        } else {
//            if ($placeholder) {
//                return $placeholder;
//            } else {
//                return '';
//            }
//        }
//    }
}
