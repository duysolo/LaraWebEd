<?php namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\CategoryMeta;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'category';
    }

    public function _handle(Request $request, Category $object, CategoryMeta $objectMeta)
    {
        $segments = $request->segments();
        $slug = end($segments);

        $item = $object->getBySlug($slug, $this->currentLanguageId);

        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this category', 'categories/edit/' . $item->id . '/' . $this->currentLanguageId);

        $this->_loadFrontMenu($item->id, 'category');
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->content_id);

        return $this->_showItem($item);
    }

    private function _showItem(Category $item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_category_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(Category $object)
    {
        $this->_setBodyClass($this->bodyClass . ' category-default');
        return $this->_viewFront('category-templates.default', $this->dis);
    }
}
