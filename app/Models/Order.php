<?php

namespace App\Models;

use App\Business\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB;


class Order extends Model
{
    //define some infomations.
    protected $table = 'order';
    protected $fillable
        = [
            'id',
            'transaction_id',
            'product_id',
            'quantity',
            'amount',
            'status',
            'data',
            'created_at',
            'update_at'
        ];
    public $timestamps = false;

    //declare some relationship.

    //relationship with product "1 order belong to 1 product"
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    //relationship with transaction "1 order belong to 1 transaction"
    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }

    //--------------------------------------------------------------------------

    public function listOrder($orderBy = null)
    {
        $result = new ResultObject();
        try {
            if ($orderBy) {
                $sql = DB::table($this->table)->orderBy('created_at', $orderBy)->paginate(10);
            } else {
                $sql = DB::table($this->table)->get()->toArray();
            }
            if ($sql) {
                $result->message = 'Successfully';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Error!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    public function listOrderByTransactionId($id, $orderBy = 'DESC')
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->select('*','order.status','order.id')
                ->join('product', 'product.id', '=', 'order.product_id')
                ->where('transaction_id', $id)
                ->orderBy('created_at', $orderBy)->paginate(10);
            if ($sql) {
                $result->message = 'Successfully';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Error!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    public function addOder($order)
    {
        $param = [];
        if (isset($order->transaction_id) && $order->transaction_id) {
            $param['transaction_id'] = $order->transaction_id;
        } else {
            $param['transaction_id'] = null;
        }
        if (isset($order->product_id) && $order->product_id) {
            $param['product_id'] = $order->product_id;
        } else {
            $param['product_id'] = null;
        }
        if (isset($order->quantity) && $order->quantity) {
            $param['quantity'] = $order->quantity;
        } else {
            $param['quantity'] = null;
        }
        if (isset($order->amount) && $order->amount) {
            $param['amount'] = $order->amount;
        } else {
            $param['amount'] = null;
        }
        if (isset($order->status) && $order->status) {
            $param['status'] = $order->status;
        } else {
            $param['status'] = 0;
        }
        if (isset($order->data) && $order->data) {
            $param['data'] = $order->data;
        } else {
            $param['data'] = null;
        }
        if (isset($order->created_at) && $order->created_at) {
            $param['created_at'] = $order->created_at;
        } else {
            $param['created_at'] = null;
        }
        if (isset($order->update_at) && $order->update_at) {
            $param['update_at'] = $order->update_at;
        } else {
            $param['update_at'] = null;
        }
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->insertGetId($param);
            if ($sql) {
                $result->message = 'Insert new order successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to insert new order!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;

    }

    public function updateOder($order)
    {
        $param = [];
        if (isset($order->transaction_id) && $order->transaction_id) {
            $param['transaction_id'] = $order->transaction_id;
        }
        if (isset($order->product_id) && $order->product_id) {
            $param['product_id'] = $order->product_id;
        }
        if (isset($order->quantity) && $order->quantity) {
            $param['quantity'] = $order->quantity;
        }
        if (isset($order->amount) && $order->amount) {
            $param['amount'] = $order->amount;
        }
        if (isset($order->status) && $order->status) {
            $param['status'] = 1;
        }else{
            $param['status'] = 0;
        }
        if (isset($order->data) && $order->data) {
            $param['data'] = $order->data;
        }
        if (isset($order->created_at) && $order->created_at) {
            $param['created_at'] = $order->created_at;
        }
        if (isset($order->update_at) && $order->update_at) {
            $param['update_at'] = $order->update_at;
        }
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('id', $order->id)
                ->update($param);
            if ($sql) {
                $result->message = 'Update new order successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to Update new order!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;

    }

    public function deleteOrder($id)
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('id', $id)->delete();
            if ($sql) {
                $result->message = 'Delete transaction successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to delete transaction!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    public function getOderById($id)
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('id', $id)->first();
            if ($sql) {
                $result->message = 'Successfully';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'Can not find any order like that';
                $result->messageCode = 0;
                $result->result = $sql;
                $result->numberOfResult = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
            $result->numberOfResult = 0;
        }

        return $result;
    }

}
