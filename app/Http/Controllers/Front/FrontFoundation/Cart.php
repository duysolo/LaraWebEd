<?php namespace App\Http\Controllers\Front\FrontFoundation;

use App\Models\Product;
use Illuminate\Http\Request;

trait Cart
{
    public $cart = [], $originalCart = [];

    protected function _unsetCart()
    {
        session(['originalCart' => []]);
    }

    protected function _getCart()
    {
        $cartSessionItems = session('originalCart');
        $totalCartItems = 0;
        if ($cartSessionItems) {
            $cartItems = [];
            $subTotal = 0;
            $totalQuantity = 0;
            foreach ($cartSessionItems as $key => $row) {
                $productContent = Product::getWithContent([
                    'product_contents.id' => [
                        'compare' => '=',
                        'value' => $row['product_content_id'],
                    ],
                    'products.status' => [
                        'compare' => '=',
                        'value' => 1,
                    ],
                    'product_contents.status' => [
                        'compare' => '=',
                        'value' => 1,
                    ],
                    'product_contents.language_id' => [
                        'compare' => '=',
                        'value' => $this->currentLanguageId,
                    ],
                ], [
                    'product_contents.*',
                    'products.global_title',
                ]);
                if ($productContent && $row['quantity'] > 0) {
                    $totalCartItems++;
                    $totalQuantity += $row['quantity'];
                    $productContent->quantity = $row['quantity'];

                    if (!$productContent->title) {
                        $productContent->title = $productContent->global_title;
                    }

                    /*Update subtotal*/
                    $price = _getPrice($productContent->price, $productContent->old_price, $productContent->sale_status, $productContent->sale_from, $productContent->sale_to);
                    $subTotal += $price * $row['quantity'];

                    $cartItems[] = $productContent;
                }
            }
            $this->cart = [
                'cartItems' => $cartItems,
                'cartSubTotal' => $subTotal,
                'totalCartQuantity' => $totalQuantity,
                'totalCartItems' => $totalCartItems,
            ];
        }
        $this->originalCart = session('originalCart');
        view()->share([
            'shoppingCart' => $this->cart,
        ]);
    }

    protected function _addToCart(Request $request, $productContentId, $quantity)
    {
        if (!$this->_checkItemExistsInCart($productContentId)) {
            if ($quantity <= 200) {
                $this->originalCart[] = [
                    'product_content_id' => $productContentId,
                    'quantity' => $quantity,
                ];
            } else {
                if (!$request->ajax()) {
                    return $this->_responseRedirect(trans('cart.maxQuantityError'), 'error');
                }

                return $this->_responseJson(true, 500, trans('cart.maxQuantityError'));
            }
        } else {
            return $this->_updateCartItem($request, $productContentId, $quantity);
        }

        session()->put('originalCart', $this->originalCart);

        if (!$request->ajax()) {
            return $this->_responseRedirect(trans('cart.updateCartCompleted'), 'success');
        }

        return $this->_responseJson(false, 200, trans('cart.updateCartCompleted'));
    }

    protected function _checkItemExistsInCart($productContentId)
    {
        foreach ($this->originalCart as $key => $row) {
            if ($row['product_content_id'] == $productContentId) {
                return true;
            }

        }
        return false;
    }

    protected function _updateCartItem(Request $request, $productContentId, $quantity)
    {
        foreach ($this->originalCart as $key => $row) {
            if ($row['product_content_id'] == $productContentId) {
                $latestQuantity = $quantity;
                if ($latestQuantity <= 10) {
                    $this->originalCart[$key]['quantity'] = $latestQuantity;
                } else {
                    session()->put('originalCart', $this->originalCart);

                    if (!$request->ajax()) {
                        return $this->_responseRedirect(trans('cart.maxQuantityError'), 'error');
                    }

                    return $this->_responseJson(true, 500, trans('cart.maxQuantityError'));
                }
            }
        }
        session()->put('cart', $this->originalCart);
        if (!$request->ajax()) {
            return $this->_responseRedirect(trans('cart.updateCartCompleted'), 'success');
        }

        return $this->_responseJson(false, 200, trans('cart.updateCartCompleted'));
    }

    protected function _deleteCartItem($productContentId)
    {
        foreach ($this->originalCart as $key => $row) {
            if ($row['product_content_id'] == $productContentId) {
                unset($this->originalCart[$key]);
            }
        }
        session()->put('originalCart', $this->originalCart);
    }
}
