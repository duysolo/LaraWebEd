<?php

if (!function_exists('_getPageLink')) {
    function _getPageLink($page, $currentLanguageCode = null)
    {
        if (!is_string($page)) {
            $page = $page->slug;
        }

        if ($currentLanguageCode) {
            return '/' . $currentLanguageCode . '/' . $page;
        }

        return '/' . $page;
    }
}

if (!function_exists('_getPostLink')) {
    function _getPostLink($post, $currentLanguageCode = null)
    {
        if (!is_string($post)) {
            $post = $post->slug;
        }

        if ($currentLanguageCode) {
            return '/' . $currentLanguageCode . '/' . trans('url.post') . '/' . $post;
        }

        return '/' . trans('url.post') . '/' . $post;
    }
}

if (!function_exists('_getProductLink')) {
    function _getProductLink($product, $currentLanguageCode = null)
    {
        if (!is_string($product)) {
            $product = $product->slug;
        }

        if ($currentLanguageCode) {
            return '/' . $currentLanguageCode . '/' . trans('url.product') . '/' . $product;
        }

        return '/' . trans('url.product') . '/' . $product;
    }
}

if (!function_exists('_getCategoryLink')) {
    function _getCategoryLink($category, $currentLanguageCode = null)
    {
        if (!is_string($category)) {
            $category = $category->slug;
        }

        if ($currentLanguageCode) {
            return '/' . $currentLanguageCode . '/' . trans('url.category') . '/' . $category;
        }

        return '/' . trans('url.category') . '/' . $category;
    }
}

if (!function_exists('_getProductCategoryLink')) {
    function _getProductCategoryLink($category, $currentLanguageCode = null)
    {
        if (!is_string($category)) {
            $category = $category->slug;
        }

        if ($currentLanguageCode) {
            return '/' . $currentLanguageCode . '/' . trans('url.productCategory') . '/' . $category;
        }

        return '/' . trans('url.productCategory') . '/' . $category;
    }
}

/*Category link with parent slugs*/
if (!function_exists('_getCategorySlugs')) {
    function _getCategorySlugs($type, $categoryId, $currentLanguageId = null)
    {
        $slug = '';
        switch ($type) {
            case 'productCategory': {
                $category = \App\Models\ProductCategory::getById($categoryId, $currentLanguageId, [], [
                    'product_categories.parent_id',
                    'product_category_contents.slug',
                ]);
            }
                break;
            default: {
                $category = \App\Models\Category::getById($categoryId, $currentLanguageId, [], [
                    'categories.parent_id',
                    'category_contents.slug',
                ]);
            }
                break;
        }
        if ($category) {
            $slug = $category->slug;
            $parentId = $category->parent_id;
            if ($parentId) {
                $parentSlug = _getCategorySlugs($type, $parentId, $currentLanguageId);
                $slug = $parentSlug . '/' . $slug;
            }
        }
        return $slug;
    }
}

if (!function_exists('_getCategoryLinkWithParentSlugs')) {
    function _getCategoryLinkWithParentSlugs($categoryId, $currentLanguageCode = null)
    {
        $currentLanguageId = \App\Models\Language::getBy(['language_code' => $currentLanguageCode], null, false, 0, ['id']);
        if ($currentLanguageCode) {
            $currentLanguageCode = $currentLanguageCode . '/';
        }
        return '/' . $currentLanguageCode . trans('url.category') . '/' . _getCategorySlugs('category', $categoryId, $currentLanguageId->id);
    }
}

if (!function_exists('_getProductCategoryLinkWithParentSlugs')) {
    function _getProductCategoryLinkWithParentSlugs($categoryId, $currentLanguageCode = null)
    {
        $currentLanguageId = \App\Models\Language::getBy(['language_code' => $currentLanguageCode], null, false, 0, ['id']);
        if ($currentLanguageCode) {
            $currentLanguageCode = $currentLanguageCode . '/';
        }
        return '/' . $currentLanguageCode . trans('url.productCategory') . '/' . _getCategorySlugs('productCategory', $categoryId, $currentLanguageId->id);
    }
}

/*CART*/
if (!function_exists('_getAddToCartLink')) {
    function _getAddToCartLink($currentLanguageCode, $productContentId, $quantity = 1)
    {
        return '/' . $currentLanguageCode . '/cart/add-to-cart/' . $productContentId . '/' . $quantity;
    }
}