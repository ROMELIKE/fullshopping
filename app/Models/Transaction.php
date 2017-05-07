<?php

namespace App\Models;

use App\Business\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    //define some infomations.
    protected $table = 'transaction';
    protected $fillable
        = [
            'id',
            'user_id',
            'date',
            'status',
            'amount',
            'username',
            'useremail',
            'useraddress',
            'userphone',
            'created_at',
            'update_at'
        ];
    public $timestamps = false;

    //declare some relationships.
    //"1 Transaction has many Order"
    public function Order()
    {
        return $this->hasMany('App\Models\Order');
    }

    //"1 Transaction belong to 1 User"
    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }

    //--------------------------------------------------------------------------

    public function listTransaction($orderBy = 'DESC')
    {
        $result = new ResultObject();
        try {
            if ($orderBy) {
                $sql = DB::table($this->table)->orderBy('created_at', $orderBy)->paginate(6);
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

    public function getTransactionById($id)
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
                $result->message = 'Failure';
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

    public function getLastestTransaction()
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->orderBy('created_at', 'DESC')
                ->first();
            if ($sql) {
                $result->message = 'Successfully';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'Failure';
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

    public function getUnPaidTransaction($orderBy = 'DESC')
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('status',0)->orderBy('created_at', $orderBy)
                ->get()->toArray();
            if ($sql) {
                $result->message = 'Successfully';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'Failure';
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

    public function addTransaction($transaction)
    {
        $param = [];
        if (isset($transaction->userphone) && $transaction->userphone) {
            $param['userphone'] = $transaction->userphone;
        } else {
            $param['userphone'] = null;
        }
        if (isset($transaction->useraddress) && $transaction->useraddress) {
            $param['useraddress'] = $transaction->useraddress;
        } else {
            $param['useraddress'] = null;
        }
        if (isset($transaction->useremail) && $transaction->useremail) {
            $param['useremail'] = $transaction->useremail;
        } else {
            $param['useremail'] = null;
        }
        if (isset($transaction->username) && $transaction->username) {
            $param['username'] = $transaction->username;
        } else {
            $param['username'] = null;
        }
        if (isset($transaction->amount) && $transaction->amount) {
            $param['amount'] = $transaction->amount;
        } else {
            $param['amount'] = null;
        }
        if (isset($transaction->status) && $transaction->status) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        if (isset($transaction->user_id) && $transaction->user_id) {
            $param['user_id'] = $transaction->user_id;
        } else {
            $param['user_id'] = null;
        }
        if (isset($transaction->created_at) && $transaction->created_at) {
            $param['created_at'] = $transaction->created_at;
        } else {
            $param['created_at'] = null;
        }
        if (isset($transaction->update_at) && $transaction->update_at) {
            $param['update_at'] = $transaction->update_at;
        } else {
            $param['update_at'] = null;
        }
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->insertGetId($param);
            if ($sql) {
                $result->message = 'Insert new transaction successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to insert new transaction!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;

    }

    public function updateTransaction($transaction)
    {
        $param = [];
        if (isset($transaction->userphone) && $transaction->userphone) {
            $param['userphone'] = $transaction->userphone;
        }
        if (isset($transaction->useraddress) && $transaction->useraddress) {
            $param['useraddress'] = $transaction->useraddress;
        }
        if (isset($transaction->useremail) && $transaction->useremail) {
            $param['useremail'] = $transaction->useremail;
        }
        if (isset($transaction->username) && $transaction->username) {
            $param['username'] = $transaction->username;
        }
        if (isset($transaction->amount) && $transaction->amount) {
            $param['amount'] = $transaction->amount;
        }
        if (isset($transaction->status) && $transaction->status) {
            $param['status'] = 1;
        }else{
            $param['status'] = 0;
        }
        if (isset($transaction->user_id) && $transaction->user_id) {
            $param['user_id'] = $transaction->user_id;
        }
        if (isset($transaction->created_at) && $transaction->created_at) {
            $param['created_at'] = $transaction->created_at;
        }
        if (isset($transaction->update_at) && $transaction->update_at) {
            $param['update_at'] = $transaction->update_at;
        }
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('id', $transaction->id)
                ->update($param);
            if ($sql) {
                $result->message = 'Update new transaction successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to Update new transaction!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    public function deleteTransaction($id)
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
}
