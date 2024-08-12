<?php

//admin
use App\Http\Controllers\admin\adminDashboardController;
use App\Http\Controllers\admin\adminUserController;
use App\Http\Controllers\admin\captchaController;
use App\Http\Controllers\admin\inquiry\adminInquiryController;
use App\Http\Controllers\admin\adminLoginController;
use App\Http\Controllers\admin\posts\adminCategoryPostController;
use App\Http\Controllers\admin\posts\adminPostController;
use App\Http\Controllers\admin\products\adminCategoryController;
use App\Http\Controllers\admin\products\adminProductController;
use App\Http\Controllers\admin\images\adminImageTypeController;
use App\Http\Controllers\admin\images\adminImagesController;
use App\Http\Controllers\admin\images\adminProductImagesController;
use App\Http\Controllers\admin\sliders\adminSliderController;
use App\Http\Controllers\admin\top_banners\adminTopBannerController;
use App\Http\Controllers\admin\accounts\adminGameAccountController;
use App\Http\Controllers\admin\accounts\adminGameAccountFieldController;
use App\Http\Controllers\admin\about_us\adminAboutUsController;
use App\Http\Controllers\admin\faq\adminCategoryFaqController;
use App\Http\Controllers\admin\faq\adminFaqController;
use App\Http\Controllers\admin\contact\adminContactController;
use App\Http\Controllers\admin\contact\adminContactSettingController;
use App\Http\Controllers\admin\rules\adminRulesController;

//site
use App\Http\Controllers\site\home\homeController;
use App\Http\Controllers\site\about_us\aboutUsController;
use App\Http\Controllers\site\contact\contactController;
use App\Http\Controllers\site\faq\faqController;
use App\Http\Controllers\site\rule\ruleController;
use App\Http\Controllers\site\blog\blogController;
use App\Http\Controllers\site\blog\blogSingleController;
use App\Http\Controllers\site\login\loginController;
use App\Http\Controllers\site\login\registerController;
use App\Http\Controllers\site\login\forgotPasswordController;
use App\Http\Controllers\site\google_play\googlePlayController;
use App\Http\Controllers\site\foreign_payment\foreignPaymentController;

use Illuminate\Support\Facades\Route;

//*****************site**************

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('get-captcha/{c}', [captchaController::class, 'index'])->name('get_captcha');

//Admin
Route::namespace('App\Http\Controllers\admin')
    ->middleware('adminAuth')
    ->name('admin.')
    ->prefix('/panel')
    ->group(function () {
        //dashboard
        Route::get('dashboard', [adminDashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [adminDashboardController::class, 'profile'])->name('profile');
        Route::post('profile/update', [adminDashboardController::class, 'profile_update'])->name('profile_update');
        Route::post('change-pass', [adminDashboardController::class, 'changePass'])->name('changePass');

        //users
        Route::get('users', [adminUserController::class, 'index'])->name('users');
        Route::post('users/search', [adminUserController::class, 'search'])->name('users.search');
        Route::get('users/edit/{user_id}', [adminUserController::class, 'edit'])->name('users.edit');
        Route::post('users/update/{user_id}', [adminUserController::class, 'update'])->name('users.update');
        Route::post('users/delete', [adminUserController::class, 'delete'])->name('users.delete');

        //category posts
        Route::resource('category_post', adminCategoryPostController::class);

        //posts
        Route::resource('posts', adminPostController::class);

        //category_product
        Route::get('category_product', [adminCategoryController::class, 'index'])
            ->name('category_product_panel');
        Route::get('category_product_create', [adminCategoryController::class, 'create'])
            ->name('category_product_create_panel');
        Route::get('category_product_store', [adminCategoryController::class, 'store'])
            ->name('category_product_store_panel');
        Route::get('category_product_edit/{id}', [adminCategoryController::class, 'edit'])
            ->name('category_product_edit_panel');
        Route::post('category_product_update/{id}', [adminCategoryController::class, 'update'])
            ->name('category_product_update_panel');
        Route::post('category_product_delete/{id}', [adminCategoryController::class, 'delete'])
            ->name('category_product_delete_panel');

        //product
        Route::get('product', [adminProductController::class, 'index'])
            ->name('product_panel');
        Route::get('product_create', [adminProductController::class, 'create'])
            ->name('product_create_panel');
        Route::post('product_store', [adminProductController::class, 'store'])
            ->name('product_store_panel');
        Route::get('product_edit/{id}', [adminProductController::class, 'edit'])
            ->name('product_edit_panel');
        Route::post('product_update/{id}', [adminProductController::class, 'update'])
            ->name('product_update_panel');
        Route::post('product_delete/{product_id}', [adminProductController::class, 'delete'])
            ->name('product_delete');

        //image type
        Route::get('image_type', [adminImageTypeController::class, 'index'])
            ->name('image_type_panel');
        Route::get('image_type_create', [adminImageTypeController::class, 'create'])
            ->name('image_type_create_panel');
        Route::get('image_type_store', [adminImageTypeController::class, 'store'])
            ->name('image_type_store_panel');
        Route::get('image_type_edit/{id}', [adminImageTypeController::class, 'edit'])
            ->name('image_type_edit_panel');
        Route::post('image_type_update/{id}', [adminImageTypeController::class, 'update'])
            ->name('image_type_update_panel');
        Route::post('image_type_delete/{id}', [adminImageTypeController::class, 'delete'])
            ->name('image_type_delete_panel');

        //image name
        Route::get('image_name', [adminImagesController::class, 'index'])
            ->name('images_panel');
        Route::get('images_create', [adminImagesController::class, 'create'])
            ->name('images_create_panel');
        Route::post('images_store', [adminImagesController::class, 'store'])
            ->name('images_store_panel');
        Route::get('images_edit/{id}', [adminImagesController::class, 'edit'])
            ->name('images_edit_panel');
        Route::post('images_update/{id}', [adminImagesController::class, 'update'])
            ->name('images_update_panel');
        Route::post('images_delete/{id}', [adminImagesController::class, 'delete'])
            ->name('images_delete_panel');
        Route::post('image_activate_panel', [adminImagesController::class, 'activate'])
            ->name('image_activate_panel');

        //product image
        Route::get('product_images/{id}', [adminProductImagesController::class, 'index'])
            ->name('product_images_panel');
        Route::post('product_images_store/{product_id}', [adminProductImagesController::class, 'store'])
            ->name('product_images_store');
        Route::post('product_images_delete/{product_image_id}', [adminProductImagesController::class, 'delete'])
            ->name('product_images_delete');

        //slider
        Route::get('slider_images', [adminSliderController::class, 'index'])
            ->name('slider_images_panel');
        Route::post('slider_images_store', [adminSliderController::class, 'store'])
            ->name('slider_images_store');
        Route::post('slider_images_delete/{slider_id}', [adminSliderController::class, 'delete'])
            ->name('slider_images_delete');

        //top banner
        Route::get('top_banner_images', [adminTopBannerController::class, 'index'])
            ->name('top_banner_images_panel');
        Route::post('top_banner_images_store', [adminTopBannerController::class, 'store'])
            ->name('top_banner_images_store');
        Route::post('top_banner_images_delete/{top_banner_id}', [adminTopBannerController::class, 'delete'])
            ->name('top_banner_images_delete');
        Route::post('show_banner', [adminTopBannerController::class, 'show_banner'])
            ->name('show_banner');
        Route::post('deactive_banner', [adminTopBannerController::class, 'deactive_banners'])
            ->name('deactive_banner');

        //inquiry site
        Route::get('inquiry_panel', [adminInquiryController::class, 'index'])
            ->name('inquiry_panel');
        Route::get('inquiry_update_panel/{inquiry_id}', [adminInquiryController::class, 'update'])
            ->name('inquiry_update_panel');
        Route::get('inquiry_delete_panel/{inquiry_id}', [adminInquiryController::class, 'delete'])
            ->name('inquiry_delete_panel');
        Route::post('inquiry_detail_panel/{inquiry_id}', [adminInquiryController::class, 'detail'])
            ->name('inquiry_detail_panel');

        //game account
        Route::get('game_account', [adminGameAccountController::class, 'index'])
            ->name('game_account_panel');
        Route::get('game_account_create', [adminGameAccountController::class, 'create'])
            ->name('game_account_create_panel');
        Route::get('game_account_store', [adminGameAccountController::class, 'store'])
            ->name('game_account_store_panel');
        Route::get('game_account_edit/{id}', [adminGameAccountController::class, 'edit'])
            ->name('game_account_edit_panel');
        Route::post('game_account_update/{id}', [adminGameAccountController::class, 'update'])
            ->name('game_account_update_panel');
        Route::post('game_account_delete/{id}', [adminGameAccountController::class, 'delete'])
            ->name('game_account_delete_panel');

        //game account field
        Route::get('game_account_field', [adminGameAccountFieldController::class, 'index'])
            ->name('game_account_field_panel');
        Route::get('game_account_field_create', [adminGameAccountFieldController::class, 'create'])
            ->name('game_account_field_create_panel');
        Route::get('game_account_field_store', [adminGameAccountFieldController::class, 'store'])
            ->name('game_account_field_store_panel');
        Route::get('game_account_field_edit/{id}', [adminGameAccountFieldController::class, 'edit'])
            ->name('game_account_field_edit_panel');
        Route::post('game_account_field_update/{id}', [adminGameAccountFieldController::class, 'update'])
            ->name('game_account_field_update_panel');
        Route::post('game_account_field_delete/{id}', [adminGameAccountFieldController::class, 'delete'])
            ->name('game_account_field_delete_panel');

        //about us
        Route::get('about_us', [adminAboutUsController::class, 'index'])
            ->name('about_us_panel');
        Route::post('about_us_update', [adminAboutUsController::class, 'update'])
            ->name('about_us_update_panel');

        //contact
        Route::get('contact', [adminContactController::class, 'index'])
            ->name('contact_panel');
        Route::get('contact_show', [adminContactController::class, 'show'])
            ->name('contact_show_panel');
        Route::post('contact_delete/{id}', [adminContactController::class, 'delete'])
            ->name('contact_delete_panel');

        //contact setting
        Route::get('setting_contact', [adminContactSettingController::class, 'index'])
            ->name('setting_contact_panel');
        Route::post('setting_contact_update', [adminContactSettingController::class, 'update'])
            ->name('setting_contact_update_panel');

        //faq category_post
        Route::get('category_faq', [adminCategoryFaqController::class, 'index'])
            ->name('faq_category_panel');
        Route::get('faq_category_create', [adminCategoryFaqController::class, 'create'])
            ->name('faq_category_create_panel');
        Route::get('faq_category_store', [adminCategoryFaqController::class, 'store'])
            ->name('faq_category_store_panel');
        Route::get('faq_category_edit/{id}', [adminCategoryFaqController::class, 'edit'])
            ->name('faq_category_edit_panel');
        Route::post('faq_category_update/{id}', [adminCategoryFaqController::class, 'update'])
            ->name('faq_category_update_panel');
        Route::post('faq_category_delete/{id}', [adminCategoryFaqController::class, 'delete'])
            ->name('faq_category_delete_panel');

        //faq
        Route::get('faq', [adminFaqController::class, 'index'])
            ->name('faq_panel');
        Route::get('faq_create', [adminFaqController::class, 'create'])
            ->name('faq_create_panel');
        Route::post('faq_store', [adminFaqController::class, 'store'])
            ->name('faq_store_panel');
        Route::get('faq_edit/{id}', [adminFaqController::class, 'edit'])
            ->name('faq_edit_panel');
        Route::post('faq_update/{id}', [adminFaqController::class, 'update'])
            ->name('faq_update_panel');
        Route::post('faq_delete/{id}', [adminFaqController::class, 'delete'])
            ->name('faq_delete_panel');

        //rules
        Route::get('rule', [adminRulesController::class, 'index'])
            ->name('rule_panel');
        Route::get('rule_create', [adminRulesController::class, 'create'])
            ->name('rule_create_panel');
        Route::post('rule_store', [adminRulesController::class, 'store'])
            ->name('rule_store_panel');
        Route::get('rule_edit/{id}', [adminRulesController::class, 'edit'])
            ->name('rule_edit_panel');
        Route::post('rule_update/{id}', [adminRulesController::class, 'update'])
            ->name('rule_update_panel');
        Route::post('rule_delete/{id}', [adminRulesController::class, 'delete'])
            ->name('rule_delete_panel');
    });

//site
Route::namespace('App\Http\Controllers\site')
    ->name('site.')
    ->prefix('')
    ->group(function () {

        //home
        Route::get('/', [homeController::class, 'index'])
            ->name('home');

        Route::post('/search', [homeController::class, 'search'])->name('search');

        //about_us
        Route::get('about_us', [aboutUsController::class, 'index'])
            ->name('about_us');

        //contact
        Route::get('contact', [contactController::class, 'index'])
            ->name('contact');

        Route::post('contact_store', [contactController::class, 'store'])
            ->name('contact_store');

        //faq
        Route::get('faq',[faqController::class,'index'])
            ->name('faq');

        Route::get('get_faqs/{cat_id}',[faqController::class,'get_faqs'])
            ->name('get_faqs');

        //rule
        Route::get('rule',[ruleController::class,'index'])
            ->name('rule');
        Route::get('rule_detail/{id}',[ruleController::class,'detail'])
            ->name('rule_detail');

        //blog
        Route::get('blog',[blogController::class,'index'])
            ->name('blog');

        //blog_single
        Route::get('blog_single',[blogSingleController::class,'index'])
            ->name('blog_single');

        //login
        Route::get('login',[loginController::class,'index'])
            ->name('login');

        //register
        Route::get('register',[registerController::class,'index'])
            ->name('register');

        Route::post('user_store',[registerController::class,'store'])
            ->name('user_store');

        //forgot-password
        Route::get('forgot-password',[forgotPasswordController::class,'index'])
            ->name('forgot-password');

        //google_play
        Route::get('google_play',[googlePlayController::class,'index'])
            ->name('google_play');

        //foreign_payment
        Route::get('foreign_payment',[foreignPaymentController::class,'index'])
            ->name('foreign_payment');

        //category_post
//        Route::get('category_post',)

    });

//login & logout
Route::middleware('loginMiddleware')
    ->get('/admin-login', [adminLoginController::class, 'index'])
    ->name('login.view');

Route::post('/login/do', [adminLoginController::class, 'do_login'])
    ->name('login.do');

Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('login.view');
})->name('logout');

Route::get('/site_logout', function () {
    auth()->logout();
    return redirect()->route('site.home');
})->name('site_logout');