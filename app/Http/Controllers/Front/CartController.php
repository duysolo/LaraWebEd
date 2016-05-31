<?php namespace App\Http\Controllers\Front;

use App\Models;
use Illuminate\Http\Request;

class CartController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'cart';
    }

    public function getAddToCart(Request $request, $productContentId, $quantity = 1)
    {
        $this->_unsetCart();
        $product = Models\ProductContent::find($productContentId);
        if ($product) {
            $quantity = ($request->get('quantity', null)) ? (int) $request->get('quantity', null) : (int) $quantity;
            if ((int) $quantity < 1) {
                $quantity = 1;
            }

            return $this->_addToCart($request, (int) $productContentId, (int) $quantity);
        }
        if (!$request->ajax()) {
            return $this->_responseRedirect(trans('cart.addCartError'), 'error');
        }

        return $this->_responseJson(true, 500, trans('cart.addCartError'));
    }

    public function getUpdateCartQuantity(Request $request, $productContentId, $quantity)
    {
        $this->_unsetCart();
        $product = Models\ProductContent::find($productContentId);
        if ($product) {
            $quantity = (int) $quantity;
            if ((int) $quantity < 1) {
                $quantity = 1;
            }

            return $this->_addToCart($request, (int) $productContentId, (int) $quantity);
        }
        if (!$request->ajax()) {
            return $this->_responseRedirect(trans('cart.productNotExistsInCart'), 'error');
        }

        return $this->_responseJson(true, 500, trans('cart.productNotExistsInCart'));
    }

    public function getDelete(Request $request, $id)
    {
        if ($this->_checkItemExistsInCart($id)) {
            $this->_deleteCartItem($id);
            if (!$request->ajax()) {
                return $this->_responseRedirect(trans('cart.updateCartCompleted'), 'success');
            }

            return $this->_responseJson(false, 200, trans('cart.updateCartCompleted'));
        }
        if (!$request->ajax()) {
            return $this->_responseRedirect(trans('cart.productNotExistsInCart'), 'error');
        }

        return $this->_responseJson(true, 500, trans('cart.productNotExistsInCart'));
    }
}
