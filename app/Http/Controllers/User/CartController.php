<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;

class CartController extends Controller
{
    public function getCart()
    {
        $content = Cart::content();
        $total = Cart::total();

        return view('user.page.cart', compact('content', 'total'));
    }

    public function deleteCart($rowid)
    {
        Cart::remove($rowid);

        return redirect()->route('getcart',
            with([
                'level' => 'success',
                'message' => 'deleted successfully!'
            ]));
    }

    public function deleteAll()
    {
        Cart::destroy();

        return redirect()->route('getcart',
            with([
                'level' => 'success',
                'message' => 'Cart is empty!'
            ]));
    }

    public function updateCart($id, Request $request)
    {
        $value = $request->qty;
        Cart::update($id, $value);

        return redirect()->route('getcart',
            with([
                'level' => 'success',
                'message' => 'Cart is updated!'
            ]));
    }
}
