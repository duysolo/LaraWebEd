<?php

namespace App\Http\Controllers\Admin;

use App\Models;
use Illuminate\Http\Request;

class MediaController extends BaseAdminController
{
    public $bodyClass = 'media-controller media-page';
    public function __construct()
    {
        parent::__construct();

        $this->_setPageTitle('Media', 'manage all medias');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu('medias');
    }

    public function getIndex(Request $request)
    {
        return $this->_viewAdmin('medias.index', $this->dis);
    }
}