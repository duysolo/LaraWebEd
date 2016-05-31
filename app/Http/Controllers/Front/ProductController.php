<?php namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\ProductMeta;
use Illuminate\Http\Request;

class ProductController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'product';
    }

    public function _handle(Request $request, Product $object, ProductMeta $objectMeta, $slug)
    {
        $item = $object->getBySlug($slug, $this->currentLanguageId);

        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this product', 'products/edit/' . $item->product_id . '/' . $this->currentLanguageId);

        $this->_loadFrontMenu();
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->id);

        return $this->_showItem($item);
    }

    private function _showItem(Product $item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_product_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(Product $object)
    {
        $this->_setBodyClass($this->bodyClass . ' product-default');
        return $this->_viewFront('product-templates.default', $this->dis);
    }
}
