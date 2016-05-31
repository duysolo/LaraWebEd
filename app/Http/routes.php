<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->group(['middleware' => ['web']], function ($router) {
    /*
    |--------------------------------------------------------------------------
    | START Routes for Admin actions
    |--------------------------------------------------------------------------
     */
    $adminCpAccess = \Config::get('app.adminCpAccess');

    $router->group(['namespace' => 'Admin', 'prefix' => $adminCpAccess], function ($router) use ($adminCpAccess) {
        /*Auth*/
        $router->controller('auth', 'AuthController');

        $router->get('/', function () use ($adminCpAccess) {
            return redirect()->to($adminCpAccess . '/dashboard');
        });

        /*Dashboard*/
        $router->controller('dashboard', 'DashboardController');

        /*Users*/
        $router->controller('users', 'UserController');
        $router->controller('admin-users', 'UserAdminController');

        /*Pages*/
        $router->controller('pages', 'PageController');

        /*Posts*/
        $router->controller('posts', 'PostController');

        /*Categories*/
        $router->controller('categories', 'CategoryController');

        /*Products*/
        $router->controller('products', 'ProductController');

        /*Product categories*/
        $router->controller('product-categories', 'ProductCategoryController');

        /*Coupons*/
        $router->controller('coupons', 'CouponController');

        /*Brands*/
        $router->controller('brands', 'BrandController');

        /*Settings*/
        $router->controller('settings', 'SettingController');

        /*Menus*/
        $router->controller('menus', 'MenuController');

        /*Files*/
        $router->controller('files', 'FileController');

        /*Custom fields*/
        $router->controller('custom-fields', 'CustomFieldController');

        /*Countries - Cities*/
        $router->controller('countries-cities', 'CountryCityController');

        /*Contacts*/
        $router->controller('contacts', 'ContactController');

        /*Subscribed emails*/
        $router->controller('subscribed-emails', 'SubscribedEmailController');
    });
    /*
    |--------------------------------------------------------------------------
    | END Routes for Admin actions
    |--------------------------------------------------------------------------
     */

    /*
    |--------------------------------------------------------------------------
    | START Routes for Front actions
    |--------------------------------------------------------------------------
     */
    $languages = \App\Models\Language::getAllLanguageCodes();

    $defaultLanguage = \App\Models\Language::getDefaultLanguage();
    if ($defaultLanguage) {
        $defaultLanguageCode = $defaultLanguage->language_code;
    } else {
        $defaultLanguageCode = 'en';
    }

    $currentLanguageCode = Request::segment(1, $defaultLanguageCode);

    if (in_array($currentLanguageCode, $languages)) {
        $currentLanguage = \App\Models\Language::getLanguageByCode($currentLanguageCode);

        $router->get('/', function () use ($currentLanguageCode) {
            return redirect()->to($currentLanguageCode);
        });

        $router->group(['namespace' => 'Front', 'prefix' => $currentLanguageCode], function ($router) use ($currentLanguage) {
            /*Set locale*/
            app()->setLocale($currentLanguage->default_locale);

            $router->controller('auth', 'AuthController');
            $router->controller('password', 'PasswordController');

            //To use cart functions, uncomment this line
            //$router->controller('cart', 'CartController');

            $router->controller('global-actions', 'GlobalActionsController');

            $router->get('/', 'PageController@index');
            $router->get('/{slug_1}', 'PageController@_handle');

            $router->get('/' . trans('url.post') . '/{slug_1}', 'PostController@_handle');

            $router->get('/' . trans('url.category') . '/{slug_1}', 'CategoryController@_handle');
            $router->get('/' . trans('url.category') . '/{slug_1}/{slug_2}', 'CategoryController@_handle');
            $router->get('/' . trans('url.category') . '/{slug_1}/{slug_2}/{slug_3}', 'CategoryController@_handle');

            $router->get('/' . trans('url.product') . '/{slug_1}', 'ProductController@_handle');

            $router->get('/' . trans('url.productCategory') . '/{slug_1}', 'ProductCategoryController@_handle');
            $router->get('/' . trans('url.productCategory') . '/{slug_1}/{slug_2}', 'ProductCategoryController@_handle');
            $router->get('/' . trans('url.productCategory') . '/{slug_1}/{slug_2}/{slug_3}', 'ProductCategoryController@_handle');
        });
    }
    /*
|--------------------------------------------------------------------------
| END Routes for Front actions
|--------------------------------------------------------------------------
 */
});
