<?php

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

/*CART*/
function _getAddToCartLink($currentLanguageCode, $productContentId, $quantity = 1)
{
    return '/' . $currentLanguageCode . '/cart/add-to-cart/' . $productContentId . '/' . $quantity;
}
