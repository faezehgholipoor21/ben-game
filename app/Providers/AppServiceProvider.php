<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\RoleUser;
use App\Models\User;
use App\Observers\OrderObserver;
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
    public function boot(): void
    {
        Paginator::useBootstrap();

        Order::observe(OrderObserver::class);

        View::composer(["admin.*"], function ($view) {
            $user_info = User::query()
                ->where('id', auth()->id())
                ->firstOrFail();

            //get profile image
//            $image_name = $user_info->image_name;
            $placeholder = asset('admin/assets/image_name/placeholders/user_placeholder.png');
//            $profile = $this->get_user_image($image_name, 'profile', $placeholder, false);
//            $user_info['profile'] = $profile;

            $view->with('user_info', $user_info);
        });

        View::composer(['admin.*'], function ($view) {
            $full_order_count = Order::query()
                ->count();

            $view->with('full_order_count', $full_order_count);
        });

        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_first = 0;
            if (auth()->check()) {
                $my_order_status_count_first = Order::query()
                    ->where('order_status', 1)
                    ->count();
            }
            $view->with('my_order_status_count_first', $my_order_status_count_first);
        });

        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_second = 0;
            if (auth()->check()) {
                $my_order_status_count_second = Order::query()
                    ->where('order_status', 2)
                    ->count();
            }
            $view->with('my_order_status_count_second', $my_order_status_count_second);
        });

        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_third = 0;
            if (auth()->check()) {
                $my_order_status_count_third = Order::query()
                    ->where('order_status', 3)
                    ->count();
            }
            $view->with('my_order_status_count_third', $my_order_status_count_third);
        });
        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_forth = 0;
            if (auth()->check()) {
                $my_order_status_count_forth = Order::query()
                    ->where('order_status', 4)
                    ->count();
            }
            $view->with('my_order_status_count_forth', $my_order_status_count_forth);
        });

        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_five = 0;
            if (auth()->check()) {
                $my_order_status_count_five = Order::query()
                    ->where('order_status', 5)
                    ->count();
            }
            $view->with('my_order_status_count_five', $my_order_status_count_five);
        });
        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_six = 0;
            if (auth()->check()) {
                $my_order_status_count_six = Order::query()
                    ->where('order_status', 6)
                    ->count();
            }
            $view->with('my_order_status_count_six', $my_order_status_count_six);
        });
        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_seven = 0;
            if (auth()->check()) {
                $my_order_status_count_seven = Order::query()
                    ->where('order_status', 7)
                    ->count();
            }
            $view->with('my_order_status_count_seven', $my_order_status_count_seven);
        });
        View::composer(['admin.*'], function ($view) {
            $my_order_status_count_eight = 0;
            if (auth()->check()) {
                $my_order_status_count_eight = Order::query()
                    ->where('order_status', 8)
                    ->count();
            }
            $view->with('my_order_status_count_eight', $my_order_status_count_eight);
        });



//        admin norm ********************
        View::composer(['admin_norm.*'], function ($view) {
            $full_order_count = Order::query()
                ->count();

            $view->with('full_order_count', $full_order_count);
        });

        View::composer(['admin_norm.*'], function ($view) {
            $full_my_order_count = 0;
            if (auth()->check()) {
                $full_my_order_count = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->count();
            }
            $view->with('full_my_order_count', $full_my_order_count);
        });

        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_first = 0;
            if (auth()->check()) {
                $my_order_status_count_first = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 1)
                    ->count();
            }
            $view->with('my_order_status_count_first', $my_order_status_count_first);
        });
        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_second = 0;
            if (auth()->check()) {
                $my_order_status_count_second = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 2)
                    ->count();
            }
            $view->with('my_order_status_count_second', $my_order_status_count_second);
        });
        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_third = 0;
            if (auth()->check()) {
                $my_order_status_count_third = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 3)
                    ->count();
            }
            $view->with('my_order_status_count_third', $my_order_status_count_third);
        });
        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_forth = 0;
            if (auth()->check()) {
                $my_order_status_count_forth = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 4)
                    ->count();
            }
            $view->with('my_order_status_count_forth', $my_order_status_count_forth);
        });
        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_five = 0;
            if (auth()->check()) {
                $my_order_status_count_five = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 5)
                    ->count();
            }
            $view->with('my_order_status_count_five', $my_order_status_count_five);
        });
        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_six = 0;
            if (auth()->check()) {
                $my_order_status_count_six = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 6)
                    ->count();
            }
            $view->with('my_order_status_count_six', $my_order_status_count_six);
        });
        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_seven = 0;
            if (auth()->check()) {
                $my_order_status_count_seven = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 7)
                    ->count();
            }
            $view->with('my_order_status_count_seven', $my_order_status_count_seven);
        });
        View::composer(['admin_norm.*'], function ($view) {
            $my_order_status_count_eight = 0;
            if (auth()->check()) {
                $my_order_status_count_eight = Order::query()
                    ->where('review_expert_id', auth()->user()->id)
                    ->where('order_status', 8)
                    ->count();
            }
            $view->with('my_order_status_count_eight', $my_order_status_count_eight);
        });



        View::composer(['user.*'], function ($view) {
            $user_order_count = 0;
            if (auth()->check()) {
                $user_order_count = Order::query()
                    ->where('user_id', auth()->user()->id)
                    ->count();
            }
            $view->with('user_order_count', $user_order_count);
        });


        View::composer(['*'], function ($view) {
            $category_info = Category::query()
                ->get();

            $view->with('category_info', $category_info);
        });

        View::composer(['*'], function ($view) {
            if (isset($_COOKIE['cart_id'])) {
                $cart_count = Cart::query()
                    ->where('cookie', $_COOKIE['cart_id'])
                    ->count();
            } else {
                $cart_count = 0;
            }

            $view->with('cart_count', $cart_count);
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
                    ->where('user_id', $user_info['id'])
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
