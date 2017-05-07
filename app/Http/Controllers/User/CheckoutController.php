<?php

namespace App\Http\Controllers\User;

use App\Business\OrderObject;
use App\Business\TransactionObject;
use App\Http\Requests\user\CheckoutRequest;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart, Auth;

class CheckoutController extends Controller
{
    public function getCheckout()
    {
        $total = Cart::total();

        return view('user.page.checkout', compact('total'));
    }

    public function postCheckout(CheckoutRequest $request)
    {
        //check cartcontent:
        if(count(Cart::content())){
            //get the variable:
            $transaction = new TransactionObject();
            if (Auth::guard('simpleUser')->check()) {
                $transaction->user_id = (Auth::guard('simpleUser')->user()['id']);
            } else {
                $customer_id = null;
            }
            $transaction->username = $request->name;
            $transaction->useremail = $request->email;
            $transaction->userphone = $request->phone;
            $transaction->useraddress = $request->address;
            $transaction->message = $request->message;
            $transaction->amount = floatval(Cart::total());
            $transaction->created_at = date('y-m-d H:i:s');

//            dd($transaction);
            $model = new Transaction();
            $addTransaction = $model->addTransaction($transaction);
            //Handle order detail:
            if ($addTransaction->messageCode) {
                //save the order table:

                foreach (Cart::content() as $item) {
                    $order = new OrderObject();

                    $order->transaction_id = $addTransaction->result;
                    $order->product_id = $item->id;
                    $order->quantity = $item->qty;
                    $order->status = 0;
                    $order->amount = $order->quantity * $item->price;
                    $order->created_at = date('y-m-d H:i:s');
                    $orderModel = new Order();
                    $addOrder = $orderModel->addOder($order);
                }
                if ($addOrder->messageCode) {
                    Cart::destroy();

                    return redirect()->route('gethome')->with([
                        'level' => 'success',
                        'message' => 'Suscessfully!! please check your mail to see your order, Thankyou!'
                    ]);

                } else {
                    echo "<script>alert('Sorry!! We cannot checkout for you!now');
            window.location = '".url('/')."'
            </script>";
                }
            }
        }else{
            return redirect()->route('gethome')->with([
                'level' => 'info',
                'message' => 'Oop!! Cart is empty, let shopping!'
            ]);
        }
    }
}
