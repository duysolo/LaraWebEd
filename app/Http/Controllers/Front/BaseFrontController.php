<?php namespace App\Http\Controllers\Front;

use Acme;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Request;
use App\Models;

abstract class BaseFrontController extends BaseController
{
    protected $dis = [], $bodyClass = '', $showSidebar = false;

    public function __construct()
    {
        parent::__construct();
        if ($this->_showConstructionMode()) {
            abort(503);
        }
        $this->_setMetaSEO();

        $this->_showSidebar($this->showSidebar);
    }

    protected function _showSidebar($bool) {
        view()->share('showSidebar', $bool);
        if($bool) {
            $this->_getSideBarLeft();
        }
    }

    protected function _loadFrontMenu($menuActive = '', $type = 'custom-link')
    {
        $menu = new Acme\CmsMenu();
        $menu->localeObj = $this->currentLanguage;
        $menu->languageCode = $this->currentLanguage->language_code;
        $menu->args = array(
            'menuName' => 'main-menu',
            'menuClass' => 'nav navbar-nav',
            'container' => '',
            'containerClass' => '',
            'containerId' => '',
            'containerTag' => 'ul',
            'childTag' => 'li',
            'itemHasChildrenClass' => 'menu-item-has-children',
            'subMenuClass' => 'dropdown-menu sub-menu',
            'menuActive' => [
                'type' => $type,
                'related_id' => $menuActive
            ],
            'activeClass' => 'active current-menu-item',
            'isAdminMenu' => false,
        );
        view()->share('CMSMenuHtml', $menu->getNavMenu());
    }

    protected function _setPageTitle($title)
    {
        view()->share([
            'pageTitle' => $title
        ]);
    }

    protected function _setCurrentEditLink($title, $link)
    {
        view()->share([
            'currentFrontEditLink' => [
                'title' => $title,
                'link' => '/' . $this->adminCpAccess . '/' . $link
            ]
        ]);
    }

    protected function _getAllCustomFields($modelObject, $contentId)
    {
        $this->dis['currentObjectCustomFields'] = $modelObject->getAllContentMeta($contentId);
    }

    protected function _setMetaSEO($keywords = null, $description = null, $image = null)
    {
        $data = [];
        if ($keywords) {
            $data['keywords'] = $keywords;
        } else {
            $data['keywords'] = $this->_getSetting('site_keywords');
        }
        if ($description) {
            $data['description'] = $description;
        } else {
            $data['description'] = $this->_getSetting('site_keywords');
        }
        if ($image) {
            $data['image'] = asset($image);
        } else {
            $data['image'] = asset($this->_getSetting('site_logo'));
        }
        view()->share([
            'metaSEO' => $data
        ]);
    }

    protected function _getSideBarLeft() {
        $categories = Models\Category::getWithContent([
            'parent_id' => [
                'compare' => '=',
                'value' => 6
            ]
        ], [
            'order' => 'ASC'
        ], true, 0);
        foreach ($categories as $key => $row) {
            $posts = Models\Post::getPostsByCategory($row->category_id, $this->currentLanguageId, [], [
                'posts.order' => 'ASC'
            ], 0, [
                'posts.global_title', 'post_contents.*'
            ]);
            $row->relatedPosts = $posts;
        }
        view()->share([
            'sidebarCategories' => $categories
        ]);
    }
}