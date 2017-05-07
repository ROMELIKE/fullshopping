<?php

namespace App\Http\Controllers\Admin;

use App\Business\OrderObject;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function getList($id)
    {
        $transactionModel = new Transaction();
        //check $id exist? in transaction table:
        $thisTransaction = $transactionModel->getTransactionById($id);
        if ($thisTransaction->messageCode) {

            $orderModel = new Order();
            $listOrders = $orderModel->listOrderByTransactionId($id);
            if ($listOrders->messageCode) {
                $listOrder = $listOrders->result;

                return view('admin.order.list', compact(['listOrder']));
            } else {
                return view('admin.order.list');
            }
        } else {
            return redirect()->route('transaction.list')->with([
                'level' => 'warning',
                'message' => $thisTransaction->message
            ]);
        }

    }

    public function updateOrder($id)
    {
        $model = new Order();
        //check $id exist in order table:
        $thisOrder = $model->getOderById($id);
        if ($thisOrder->messageCode) {

            $order = new OrderObject();
            $order->status = !$thisOrder->result->status;
            $order->id = $id;
            $order->update_at = date('y-m-d H:i:s');

            $updateOrder = $model->updateOder($order);
            if ($updateOrder->messageCode) {
                return redirect()->back()->with([
                    'level' => 'success',
                    'message' => $updateOrder->message
                ]);
            } else {
                return redirect()->back()->with([
                    'level' => 'warning',
                    'message' => $updateOrder->message
                ]);
            }
        } else {
            return redirect()->back()->with([
                'level' => 'danger',
                'message' => $thisOrder->message
            ]);
        }
    }

    public function deleteOrder($id)
    {
        $model = new Order();
        //check $id exist in order table:
        $thisOrder = $model->getOderById($id);
        if ($thisOrder->messageCode) {
            $deleteOrder = $model->deleteOrder($id);
            if ($deleteOrder->messageCode) {
                return redirect()->back()->with([
                    'level' => 'success',
                    'message' => $deleteOrder->message
                ]);
            } else {
                return redirect()->back()->with([
                    'level' => 'warning',
                    'message' => $deleteOrder->message
                ]);
            }
        } else {
            return redirect()->back()->with([
                'level' => 'warning',
                'message' => $thisOrder->message
            ]);
        }
    }
}
