<?php

namespace App\Http\Controllers\Admin;

use App\Models;
use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{
    public $bodyClass = 'dashboard-controller dashboard-page';
    public function __construct()
    {
        parent::__construct();

        $this->_setPageTitle('Dashboard', 'dashboard & statistics');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu('dashboard');
    }

    public function getIndex(Request $request)
    {
        $dis = [];
        $pages = Models\Page::count();
        $dis['pagesCount'] = $pages;

        $posts = Models\Post::count();
        $dis['postsCount'] = $posts;

        $products = Models\Product::count();
        $dis['productsCount'] = $products;

        $users = Models\User::where(['status' => 1])->count();
        $dis['usersCount'] = $users;

        return $this->_viewAdmin('dashboard.index', $dis);
    }
}
