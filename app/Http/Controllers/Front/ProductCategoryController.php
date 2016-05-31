<?php namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryMeta;
use Illuminate\Http\Request;

class ProductCategoryController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'product-category';
    }

    public function _handle(Request $request, ProductCategory $object, ProductCategoryMeta $objectMeta)
    {
        $segments = $request->segments();
        $slug = end($segments);

        $item = $object->getBySlug($slug, $this->currentLanguageId);

        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this product category', 'product-categories/edit/' . $item->category_id . '/' . $this->currentLanguageId);

        $this->_loadFrontMenu($item->category_id, 'product-category');
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->id);

        return $this->_showItem($item);
    }

    private function _showItem($item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_productCategory_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(ProductCategory $object)
    {
        $this->_setBodyClass($this->bodyClass . ' product-category-default');
        return $this->_viewFront('product-category-templates.default', $this->dis);
    }

    /* Template Name: Fashion*/
    public function _productCategory_Fashion(ProductCategory $object)
    {
        $this->_setBodyClass($this->bodyClass . ' product-category-fashion');

        /*Get related products*/
        $this->dis['relatedProducts'] = Product::getByCategory($object->category_id, $this->currentLanguageId, [
            'products.status' => [
                'compare' => '=',
                'value' => 1,
            ],
            'product_contents.status' => [
                'compare' => '=',
                'value' => 1,
            ],
        ], [
            'products.created_at' => 'DESC',
        ], 10, [
            'product_contents.*', 'products.status as global_status',
        ]);

        return $this->_viewFront('product-category-templates.fashion', $this->dis);
    }
}
