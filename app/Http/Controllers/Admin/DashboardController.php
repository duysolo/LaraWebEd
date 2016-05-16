<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Event;
use App\Events;
use App\Models;
use Illuminate\Http\Request;

class DashboardController extends BaseAdminController
{
    var $bodyClass = 'dashboard-controller dashboard-page';
    public function __construct()
    {
        parent::__construct();

        $this->_setPageTitle('Dashboard', 'dashboard & statistics');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu('dashboard');
    }

    public function getIndex(Request $request)
    {
        return $this->_viewAdmin('dashboard.index');
    }
}