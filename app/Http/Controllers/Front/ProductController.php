<?php namespace App\Http\Controllers\Front;

use Acme;
use App\Models;
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
        $item = $object->getProductBySlug($slug, $this->currentLanguageId);

        if (!$item) return $this->_showErrorPage(404, 'Page not found');

        $this->_setCurrentEditLink('Edit this product', 'products/edit/'.$item->product_id.'/'.$this->currentLanguageId);

        $this->_loadFrontMenu();
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->id);

        return $this->_showItem($item);
    }

    private function _showItem(Product $item)
    {
        $this->_setBodyClass($this->bodyClass.' post-default');
        return $this->_viewFront('product-templates.default', $this->dis);
    }
}