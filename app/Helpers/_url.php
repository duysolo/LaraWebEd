<?php

if (! function_exists('_getPageLink')) {
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

if (! function_exists('_getPostLink')) {
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

if (! function_exists('_getProductLink')) {
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

if (! function_exists('_getCategoryLink')) {
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

if (! function_exists('_getProductCategoryLink')) {
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

/*CART*/
if (! function_exists('_getAddToCartLink')) {
    function _getAddToCartLink($currentLanguageCode, $productContentId, $quantity = 1)
    {
        return '/' . $currentLanguageCode . '/cart/add-to-cart/' . $productContentId . '/' . $quantity;
    }
}