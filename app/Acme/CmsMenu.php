<?php namespace Acme;

use App\Models;

class CmsMenu
{
    /**
     * Construct
     */
    public $localeObj, $languageCode;

    public function __construct()
    {

    }

    public $args = array(
        'menuName' => '',
        'menuClass' => '',
        'container' => '',
        'containerClass' => '',
        'containerId' => '',
        'containerTag' => 'ul',
        'childTag' => 'li',
        'itemHasChildrenClass' => '',
        'subMenuClass' => 'sub-menu',
        'menuActive' => [
            'type' => 'custom-link',
            'related_id' => 0,
        ],
        'activeClass' => 'active',
        'isAdminMenu' => false,
    );

    public function getNavMenu()
    {
        $defaultArgs = array(
            'languageId' => 0,
            'menuName' => '',
            'menuClass' => 'my-menu',
            'container' => 'nav',
            'containerClass' => '',
            'containerId' => '',
            'containerTag' => 'ul',
            'childTag' => 'li',
            'itemHasChildrenClass' => 'menu-item-has-children',
            'subMenuClass' => 'sub-menu',
            'menuActive' => [
                'type' => 'custom-link',
                'related_id' => 0,
            ],
            'activeClass' => 'active',
            'isAdminMenu' => false,
        );
        $defaultArgs = array_merge($defaultArgs, $this->args);

        $output = '';
        $menu = Models\Menu::join('menu_contents', 'menus.id', '=', 'menu_contents.menu_id')
            ->join('languages', 'languages.id', '=', 'menu_contents.language_id')
            ->where('menus.slug', '=', ltrim($defaultArgs['menuName']))
            ->where('menu_contents.language_id', '=', $defaultArgs['languageId'])
            ->select('menus.*', 'menu_contents.id as menu_content_id')
            ->first();
        // Menu exists
        if (!is_null($menu)) {
            if ($defaultArgs['container'] != '') {
                $output .= '<' . $defaultArgs['container'] . ' class="' . $defaultArgs['containerClass'] . '" id="' . $defaultArgs['containerId'] . '">';
            }
            //<nav>
            $output .= '<' . $defaultArgs['containerTag'] . ' class="' . $defaultArgs['menuClass'] . '"' . (($defaultArgs['isAdminMenu']) ? ' data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200"' : '') . '>'; //<ul>
            $child_args = array(
                'menuContentId' => $menu->menu_content_id,
                'parentId' => 0,
                'isAdminMenu' => false,
                'containerTag' => $defaultArgs['containerTag'],
                'childTag' => $defaultArgs['childTag'],
                'itemHasChildrenClass' => $defaultArgs['itemHasChildrenClass'],
                'subMenuClass' => $defaultArgs['subMenuClass'],
                'containerTagAttr' => '',
                'menuActive' => $defaultArgs['menuActive'],
                'defaultActiveClass' => $defaultArgs['activeClass'], //default active class
            );
            if ($defaultArgs['isAdminMenu'] == true) {
                $child_args['isAdminMenu'] = true;
                $output .= '<li class="sidebar-toggler-wrapper">
										<div class="sidebar-toggler">
										</div>
									</li>';
            }
            $output .= $this->getMenuItems($child_args);
            // $output.= '<div class="clearfix"></div></'.$defaultArgs['containerTag'].'>'; //</ul>
            $output .= '</' . $defaultArgs['containerTag'] . '>'; //</ul>
            if ($defaultArgs['container'] != '') {
                $output .= '</' . $defaultArgs['container'] . '>';
            }
            //</nav>
        }
        return $output;
    }

    // Function get all menu items
    private function getMenuItems($item_args)
    {
        $output = '';
        $menuItems = Models\MenuNode::getBy([
            'menu_content_id' => $item_args['menuContentId'],
            'parent_id' => $item_args['parentId'],
        ], ['position' => 'ASC'], true);

        if ($menuItems) {
            (sizeof($menuItems) > 0 && $item_args['parentId'] != 0) ? $output .= '<' . $item_args['containerTag'] . ' class="' . $item_args['subMenuClass'] . '"' . $item_args['containerTagAttr'] . '>' : $output .= ''; // <ul> will be printed if current is not level 0
            foreach ($menuItems as $key => $row) {
                $arrow = '';
                if (count($row->child) > 0) {
                    $arrow = '<span class="arrow"></span>';
                }

                // Get menu active class
                $active_args = array(
                    'menuActive' => $item_args['menuActive'],
                    'item' => $row,
                    'defaultActiveClass' => $item_args['defaultActiveClass'],
                    'isAdminMenu' => $item_args['isAdminMenu'],
                );
                $activeClass = $this->getActiveItems($active_args);
                if ($this->checkChildItemIsActive(array('parent' => $row, 'menuActive' => $item_args['menuActive'], 'defaultActiveClass' => $item_args['defaultActiveClass'], 'isAdminMenu' => $item_args['isAdminMenu'])) == true) {
                    if (trim($activeClass) == '') {
                        $activeClass = ' current-parent-item';
                        if ($item_args['isAdminMenu'] == true) {
                            $activeClass .= ' active';
                        }
                    }
                    $arrow = '<span class="arrow open"></span>';
                }

                $menu_title = $this->getMenuItemTitle($row);
                $menu_link = $this->getMenuItemLink($row, $item_args['isAdminMenu']);
                $parent_class = $row->css_class . ' ';
                if ($this->checkItemHasChildren($row)) {
                    $parent_class .= $item_args['itemHasChildrenClass'];
                }

                $child_args = array(
                    'menuContentId' => $item_args['menuContentId'],
                    'parentId' => $row->id,
                    'isAdminMenu' => $item_args['isAdminMenu'],
                    'containerTag' => $item_args['containerTag'],
                    'childTag' => $item_args['childTag'],
                    'itemHasChildrenClass' => $item_args['itemHasChildrenClass'],
                    'subMenuClass' => $item_args['subMenuClass'],
                    'containerTagAttr' => '',
                    'menuActive' => $item_args['menuActive'],
                    'defaultActiveClass' => $item_args['defaultActiveClass'], //default active class
                );

                $menu_icon = $menu_title;
                $linkClass = '';
                if ($item_args['isAdminMenu'] == true) {
                    $linkClass = ' nav-link nav-toggle ';
                    $activeClass .= ' nav-item ';
                    $menu_icon = '<i class="' . $row->icon_font . '"></i> <span class="title">' . $menu_title . '</span><span class="selected"></span>';
                    if ($this->checkItemHasChildren($row)) {
                        $menu_icon .= $arrow;
                    }
                } else {
                    if ($row->icon_font) {
                        $menu_icon = '<i class="' . $row->icon_font . '"></i>' . $menu_icon;
                    }
                    $menu_icon = '<span>' . $menu_icon . '</span>';
                }

                $output .= '<' . $item_args['childTag'] . ' class="' . $parent_class . ' ' . $activeClass . '">'; #<li>
                $output .= '<a class="' . $linkClass . '" href="' . $menu_link . '" title="' . $menu_title . '">' . $menu_icon . '</a>';
                $output .= $this->getMenuItems($child_args);
                $output .= '</' . $item_args['childTag'] . '>'; #</li>
            }
            (sizeof($menuItems) > 0 && $item_args['parentId'] != 0) ? $output .= '</' . $item_args['containerTag'] . '>' : $output .= ''; // </ul>
        }
        return $output;
    }

    // Menu active
    private function getActiveItems($args)
    {
        $temp = $args['menuActive'];
        $result = '';
        if ($args['item']->type == $args['menuActive']['type']) {
            if (is_array($args['menuActive']['related_id'])) {
                switch ($args['menuActive']['type']) {
                    case 'category':{
                            if (in_array($args['item']->related_id, $args['menuActive']['related_id'])) {
                                $result = $args['defaultActiveClass'];
                            }
                        }
                        break;
                    case 'product-category':{
                            if (in_array($args['item']->related_id, $args['menuActive']['related_id'])) {
                                $result = $args['defaultActiveClass'];
                            }
                        }
                        break;
                    default:{
                            if (in_array($args['item']->related_id, $args['menuActive']['related_id'])) {
                                $result = $args['defaultActiveClass'];
                            }
                        }
                        break;
                }
            } else {
                switch ($args['menuActive']['type']) {
                    case 'category':{
                            if ($args['menuActive']['related_id'] == $args['item']->related_id) {
                                $result = $args['defaultActiveClass'];
                            }
                        }
                        break;
                    case 'product-category':{
                            if ($args['menuActive']['related_id'] == $args['item']->related_id) {
                                $result = $args['defaultActiveClass'];
                            }
                        }
                        break;
                    case 'custom-link':{
                            $currentUrl = \Request::url();
                            if ($args['isAdminMenu']) {
                                if ($args['menuActive']['related_id'] == $args['item']->url) {
                                    $result = $args['defaultActiveClass'];
                                }
                            } else {
                                if (asset($args['item']->url) == asset($currentUrl) || asset($args['item']->url) == asset($currentUrl . '/')) {
                                    $result = $args['defaultActiveClass'];
                                }
                            }
                        }
                        break;
                    default:{
                            if ($args['menuActive']['related_id'] == $args['item']->related_id) {
                                $result = $args['defaultActiveClass'];
                            }
                        }
                        break;
                }
            }
        }
        return $result;
    }

    // Check children active
    private function checkChildItemIsActive($args)
    {
        return $this->_recursiveIsChildItemActive($args);
    }

    private function _recursiveIsChildItemActive($args)
    {
        if ($this->getActiveItems(array('menuActive' => $args['menuActive'], 'item' => $args['parent'], 'defaultActiveClass' => $args['defaultActiveClass'], 'isAdminMenu' => $args['isAdminMenu'])) != '') {
            return true;
        }
        $result = false;
        $menuNodes = Models\MenuNode::getBy([
            'parent_id' => $args['parent']->id,
        ], ['position' => 'ASC'], true);
        foreach ($menuNodes as $key => $row) {
            $childArgs = $args;
            $childArgs['parent'] = $row;
            $result = $this->_recursiveIsChildItemActive($childArgs);
            if ($result) {
                return true;
            }

        }
        return $result;
    }

    // Get item title
    private function getMenuItemTitle($item)
    {
        $data_title = '';
        switch ($item->type) {
            case 'page':{
                    $title = $item->title;
                    if (!$title) {
                        $page = Models\Page::getBy([
                            'id' => $item->related_id,
                        ]);
                        if ($page) {
                            $pageContent = $page->pageContent()->join('languages', 'languages.id', '=', 'page_contents.language_id')
                                ->where('languages.id', '=', $this->localeObj->id)
                                ->select('page_contents.title')
                                ->first();
                            if ($pageContent) {
                                $title = ((trim($pageContent->title) != '') ? trim($pageContent->title) : trim($page->global_title));
                            }
                        } else {
                            $title = '';
                        }
                    }
                    $data_title = $title;
                }
                break;
            case 'category':{
                    $title = $item->title;
                    if (!$title) {
                        $cat = Models\Category::getWithContent([
                            'categories.id' => [
                                'compare' => '=',
                                'value' => $item->related_id,
                            ],
                            'category_contents.language_id' => [
                                'compare' => '=',
                                'value' => $this->localeObj->id,
                            ],
                        ]);
                        if ($cat) {
                            $title = ((trim($cat->title) != '') ? trim($cat->title) : trim($cat->global_title));
                        } else {
                            $title = '';
                        }
                    }
                    $data_title = $title;
                }
                break;
            case 'product-category':{
                    $title = $item->title;
                    if (!$title) {
                        $cat = Models\ProductCategory::getWithContent([
                            'product_categories.id' => [
                                'compare' => '=',
                                'value' => $item->related_id,
                            ],
                            'product_category_contents.language_id' => [
                                'compare' => '=',
                                'value' => $this->localeObj->id,
                            ],
                        ]);
                        if ($cat) {
                            $title = ((trim($cat->title) != '') ? trim($cat->title) : trim($cat->global_title));
                        } else {
                            $title = '';
                        }
                    }
                    $data_title = $title;
                }
                break;
            case 'custom-link':{
                    $data_title = $item->title;
                    if (!$data_title) {
                        $data_title = '';
                    }

                }
                break;
            default:{
                    $data_title = $item->title;
                    if (!$data_title) {
                        $data_title = '';
                    }

                }
                break;
        }
        $data_title = htmlentities($data_title);
        return $data_title;
    }

    // Get item links
    private function getMenuItemLink($item, $isAdminMenu = false)
    {
        $result = '';
        switch ($item->type) {
            case 'page':{
                    $slug = '';
                    $page = Models\Page::getWithContent([
                        'pages.id' => [
                            'compare' => '=',
                            'value' => $item->related_id,
                        ],
                        'page_contents.language_id' => [
                            'compare' => '=',
                            'value' => $this->localeObj->id,
                        ],
                    ]);
                    if ($page) {
                        $slug = (trim($page->slug) != '') ? trim($page->slug) : '';
                    }

                    $result = _getPageLink($slug, $this->languageCode);
                }
                break;
            case 'category':{
                    $cat = Models\Category::getWithContent([
                        'categories.id' => [
                            'compare' => '=',
                            'value' => $item->related_id,
                        ],
                        'category_contents.language_id' => [
                            'compare' => '=',
                            'value' => $this->localeObj->id,
                        ],
                    ]);
                    if ($cat) {
                        $data_slug = ($cat && $cat->slug) ? $cat->slug : $cat->global_slug;
                        if ($cat->parent_id != 0) {
                            $data_slug = $this->getParentCategorySlugs($cat->parent_id, $data_slug);
                        }
                    } else {
                        $data_slug = '';
                    }
                    $result = _getCategoryLink($data_slug, $this->languageCode);
                }
                break;
            case 'product-category':{
                    $cat = Models\ProductCategory::getWithContent([
                        'product_categories.id' => [
                            'compare' => '=',
                            'value' => $item->related_id,
                        ],
                        'product_category_contents.language_id' => [
                            'compare' => '=',
                            'value' => $this->localeObj->id,
                        ],
                    ]);
                    if ($cat) {
                        $data_slug = ($cat && $cat->slug) ? $cat->slug : $cat->global_slug;
                        if ($cat->parent_id != 0) {
                            $data_slug = $this->getParentProductCategorySlugs($cat->parent_id, $data_slug);
                        }
                    } else {
                        $data_slug = '';
                    }
                    $result = _getProductCategoryLink($data_slug, $this->languageCode);
                }
                break;
            case 'custom-link':{
                    if ($isAdminMenu == true) {
                        $result = asset(\Config::get('app.adminCpAccess') . '/' . $item->url);
                    } else {
                        $result = $item->url;
                    }
                }
                break;
            default:{
                    if ($isAdminMenu == true) {
                        $result = asset(\Config::get('app.adminCpAccess') . '/' . $item->url);
                    } else {
                        $result = $item->url;
                    }
                }
                break;
        }
        return $result;
    }

    // Check menu has children or not
    private function checkItemHasChildren($item)
    {
        if (count($item->child) > 0) {
            return true;
        }

        return false;
    }

    /*Get parent slug*/
    private function getParentProductCategorySlugs($parentId, $currentSlug)
    {
        $result = $currentSlug;
        $cat = Models\ProductCategory::getWithContent([
            'product_categories.id' => [
                'compare' => '=',
                'value' => $parentId,
            ],
            'product_category_contents.language_id' => [
                'compare' => '=',
                'value' => $this->localeObj->id,
            ],
        ]);
        if ($cat) {
            $categorySlug = $cat->slug;
            if ($categorySlug) {
                $result = $categorySlug . '/' . $result;
            }
            if ($cat->category_id != 0) {
                $result = $this->getParentProductCategorySlugs($cat->parent_id, $result);
            }

        }
        return $result;
    }

    private function getParentCategorySlugs($parentId, $currentSlug)
    {
        $result = $currentSlug;
        $cat = Models\Category::getWithContent([
            'categories.id' => [
                'compare' => '=',
                'value' => $parentId,
            ],
            'category_contents.language_id' => [
                'compare' => '=',
                'value' => $this->localeObj->id,
            ],
        ]);
        if ($cat) {
            $categorySlug = $cat->slug;
            if ($categorySlug) {
                $result = $categorySlug . '/' . $result;
            }
            if ($cat->category_id != 0) {
                $result = $this->getParentCategorySlugs($cat->parent_id, $result);
            }

        }
        return $result;
    }
}
