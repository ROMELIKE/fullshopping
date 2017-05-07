<?php

namespace App\Http\Controllers\Admin;

use App\Business\TransactionObject;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function getList()
    {
        $model = new Transaction();
        $Transactions = $model->listTransaction('DESC');

        if ($Transactions->messageCode) {
            //change user_id in transaction -> avatar if it can.
            foreach ($Transactions->result as $item) {
                if ($item->user_id) {
                    $userModel = new User();
                    $thisUser = $userModel->getUserById($item->user_id);
                    $item->user_id = $thisUser->result->avatar;
                }

                //check transaction is empty or not?
                $orderModel = new Order();
                $isEmpty = $orderModel->listOrderByTransactionId($item->id);
                if(!$isEmpty->messageCode){
                    $item->status = 2;
                }else{

                }
            }
            $transactionList = $Transactions->result;

            return view('admin.transaction.list', compact('transactionList'));
        }

        return view('admin.transaction.list');
    }

    public function updateTransaction($id)
    {
        $model = new Transaction();
        $thisTransaction = $model->getTransactionById($id);
        if ($thisTransaction->messageCode) {

            $transaction = new TransactionObject();
            $transaction->id = $id;
            $transaction->status = !$thisTransaction->result->status;
            $transaction->update_at = date('y-d-m H:i:s');
            $updateTransaction = $model->updateTransaction($transaction);

            if($updateTransaction->messageCode){
                return redirect()->route('transaction.list')->with([
                    'level' => 'success',
                    'message' => $updateTransaction->message
                ]);
            }else{
                return redirect()->back()->with([
                    'level' => 'success',
                    'message' => $updateTransaction->message
                ]);
            }

        }else{
            return redirect()->route('transaction.list')->with([
                'level' => 'warning',
                'message' => $thisTransaction->message
            ]);
        }
    }

    public function deleteTransaction($id)
    {
        $model = new Transaction();
        $thisTransaction = $model->getTransactionById($id);
        if ($thisTransaction->messageCode) {
            $deleteTransaction = $model->deleteTransaction($id);
            if ($deleteTransaction->messageCode) {
                return redirect()->route('transaction.list')->with([
                    'level' => 'success',
                    'message' => $deleteTransaction->message
                ]);
            }else{
                return redirect()->route('transaction.list')->with([
                    'level' => 'warning',
                    'message' => $deleteTransaction->message
                ]);
            }
        }else{
            return redirect()->route('transaction.list')->with([
                'level' => 'warning',
                'message' => $thisTransaction->message
            ]);
        }
    }
}
