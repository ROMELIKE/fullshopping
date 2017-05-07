<?php

namespace App\Http\Controllers\user;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;

class ShoppingController extends Controller
{
    public function Shopping(Request $request, $id)
    {

        //get this products:
        $model = new Product();
        $thisProduct = $model->getProductById($id)->result;

        //get and set quantity of a product.
        if (isset($request->quantity) && $request->quantity) {
            $qty = $request->quantity;
        } else {
            $qty = 1;
        }
        //add more properties, want to show product.
        $array = [
            'image' => $thisProduct->image,
            'desciption' => $thisProduct->desciption,
            'discount' => $thisProduct->discount
        ];

        $cartAdd = $model->cartAdd($thisProduct, $qty, $array);
        if ($cartAdd->messageCode) {
            $content = Cart::content();
            return redirect()->route('getcart');
        }else{
            echo "<script>alert('Cart not yet readdy! sorry we will resolve soon'); window.location='"
                .url('/')."';</script>";
        }
    }
}
