<?php

namespace App\Models;

use App\Business\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB;

class Contact extends Model
{
    protected $table = 'contact';

    /**
     * @param $contact
     *
     * @return ResultObject
     *
     */
    public function addContact($contact)
    {
        $param = [];
        if (isset($contact->name) && $contact->name) {
            $param['name'] = $contact->name;
        } else {
            $param['name'] = null;
        }
        if (isset($contact->email) && $contact->email) {
            $param['email'] = $contact->email;
        } else {
            $param['email'] = null;
        }
        if (isset($contact->content) && $contact->content) {
            $param['content'] = $contact->content;
        } else {
            $param['content'] = null;
        }
        if (isset($contact->subject) && $contact->subject) {
            $param['subject'] = $contact->subject;
        } else {
            $param['subject'] = null;
        }
        if (isset($contact->created_at) && $contact->created_at) {
            $param['created_at'] = $contact->created_at;
        } else {
            $param['created_at'] = null;
        }
        if (isset($contact->update_at) && $contact->update_at) {
            $param['update_at'] = $contact->update_at;
        } else {
            $param['update_at'] = null;
        }
        if (isset($contact->status) && $contact->status) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->insertGetId($param);
            if ($sql) {
                $result->message = 'Insert new contaction successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to insert new contaction!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * @param $contact
     *
     * @return ResultObject
     */
    public function updateContact($contact)
    {
        $param = [];
        $id = $contact->id;
        if (isset($contact->name) && $contact->name) {
            $param['name'] = $contact->name;
        }
        if (isset($contact->email) && $contact->email) {
            $param['email'] = $contact->email;
        }
        if (isset($contact->message) && $contact->message) {
            $param['content'] = $contact->message;
        }
        if (isset($contact->created_at) && $contact->created_at) {
            $param['created_at'] = $contact->created_at;
        }
        if (isset($contact->update_at) && $contact->update_at) {
            $param['update_at'] = $contact->update_at;
        }
        if (isset($contact->status) && $contact->status) {
            $param['status'] = 1;
        }else{
            $param['status'] = 0;
        }
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('id', $id)->update($param);
            if ($sql) {
                $result->message = 'Update contaction successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to Update new contaction!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * @param null $orderBy
     *
     * @return ResultObject
     */
    public function listContact($orderBy = null)
    {
        $result = new ResultObject();
        try {
            if ($orderBy) {
                $sql = DB::table($this->table)->orderBy('created_at', $orderBy)->paginate(9);
            } else {
                $sql = DB::table($this->table)->orderBy('created_at', 'DESC')->paginate(9);
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

    /**
     * @param $id
     *
     * @return ResultObject
     */
    public function getContactById($id)
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

    public function getNotReadContact()
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('status',0)->orderBy('created_at', 'DESC')
                ->get()
                ->toArray();
            if ($sql) {
                $result->message = 'Successfully';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
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

    /**
     * @param $id
     *
     * @return ResultObject
     */
    public function deleteContact($id)
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('id', $id)->delete();
            if ($sql) {
                $result->message = 'Delete contact successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to delete contact!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }
}
