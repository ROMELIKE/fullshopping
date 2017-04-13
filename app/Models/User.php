<?php

namespace App\Models;

use App\Business\resultObject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $fillable
        = [
            'id',
            'name',
            'email',
            'password',
            'username',
            'status',
            'avatar',
            'accessible',
            'phone',
            'address'
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];
    //declare some relationship.
    //"1 User has many Transaction."
    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    //--------------------------------------------------------------------------


    public function AddNewUser($array)
    {
        $param = [];
        if (isset($array['name']) && $array['name']) {
            $param['name'] = $array['name'];
        } else {
            $param['name'] = 'Unknow';
        }
        if (isset($array['username']) && $array['username']) {
            $param['username'] = $array['username'];
        } else {
            $param['name'] = 'Unknow';
        }
        if (isset($array['email']) && $array['email']) {
            $param['email'] = $array['email'];
        } else {
            $param['email'] = null;
        }
        if (isset($array['password']) && $array['password']) {
            $param['password'] = $array['password'];
        } else {
            $param['password'] = null;
        }
        if (isset($array['phone']) && $array['phone']) {
            $param['phone'] = $array['phone'];
        } else {
            $param['phone'] = null;
        }
        if (isset($array['address']) && $array['address']) {
            $param['address'] = $array['address'];
        } else {
            $param['address'] = null;
        }
        if (isset($array['avatar']) && $array['avatar']) {
            $param['avatar'] = $array['avatar'];
        } else {
            $param['avatar'] = null;
        }
        if (isset($array['date']) && $array['date']) {
            $param['date'] = $array['date'];
        } else {
            $param['date'] = null;
        }
        if (isset($array['status']) && $array['status']) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        $param['accessible'] = 0;
        $param['accessible'] = 0;

        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->insertGetId($param);
            if ($sql) {
                $result->message = 'Insert new User successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Failure, Insert new User Error!!';
                $result->messageCode = 0;
                $result->result = $sql;
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL Exception!';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Get List of User.
     *
     * @param string $orderBy
     * @param string $access
     *
     * @return resultObject
     */
    public function getListUser($orderBy = 'ASC', $access = '0')
    {
        $result = new resultObject();
        if ($access == 'admin') {
            try {
                $sql = DB::table($this->table)->where('accessible', '!=', 0)
                    ->orderBy('date', $orderBy)->get()
                    ->toArray();
                if ($sql) {
                    $result->message = 'Get Adminlist successfully!!';
                    $result->messageCode = 1;
                    $result->result = $sql;
                } else {
                    $result->message = 'Failure, get Adminlist Error!!';
                    $result->messageCode = 0;
                    $result->result = $sql;
                }
            } catch (\Exception $exception) {
                $result->message = 'SQL Exception!';
                $result->messageCode = 0;
            }
        } else {
            try {
                $sql = DB::table($this->table)->where('accessible', $access)
                    ->orderBy('date', $orderBy)->get()
                    ->toArray();
                if ($sql) {
                    $result->message = 'Get Userlist successfully!!';
                    $result->messageCode = 1;
                    $result->result = $sql;
                } else {
                    $result->message = 'Failure, get Userlist Error!!';
                    $result->messageCode = 0;
                    $result->result = $sql;
                }
            } catch (\Exception $exception) {
                $result->message = 'SQL Exception!';
                $result->messageCode = 0;
            }
        }

        return $result;
    }

    /**
     * Function: Delete User
     * @param $id
     *
     * @return resultObject
     */
    public function deleteUser($id)
    {
        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->where('id', $id)->delete();
            if ($sql) {
                $result->message = 'Delete User successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Failure,Delete User Error!!';
                $result->messageCode = 0;
                $result->result = $sql;
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL Exception!';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: get user by id
     * @param $id
     *
     * @return resultObject
     */
    public function getUserById($id)
    {
        $result = new resultObject;
        try {
            $sql = DB::table($this->table)->where('id', $id)->first();
            if ($sql) {
                $result->message = 'Thành công';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'Can not find any User like that';
                $result->messageCode = 0;
                $result->result = $sql;
                $result->numberOfResult = 0;
            }
        } catch (Exception $exception) {
            $result->message = 'Sql exception';
            $result->messageCode = 0;
            $result->numberOfResult = 0;
        }

        return $result;
    }

    /**
     * Function:check 'username' is exist?
     * @param $name
     *
     * @return resultObject
     */
    public function checkUsernameExist($name)
    {
        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->where('name', $name)->get();
            if (count($sql)) {
                $result->messageCode = 0;
                $result->message
                    = 'This Username have already been use, try again.';
            } else {
                $result->messageCode = 1;
                $result->message = 'This Username Can be use.';
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Update User.
     * @param $array
     *
     * @return resultObject
     */
    public function updateUser($array)
    {
        $param = [];
        if (isset($array['name']) && $array['name']) {
            $param['name'] = $array['name'];
        }
        if (isset($array['username']) && $array['username']) {
            $param['username'] = $array['username'];
        }
        if (isset($array['address']) && $array['address']) {
            $param['address'] = $array['address'];
        }
        if (isset($array['email']) && $array['email']) {
            $param['email'] = $array['email'];
        }
        if (isset($array['phone']) && $array['phone']) {
            $param['phone'] = $array['phone'];
        }
        if (isset($array['avatar']) && $array['avatar']) {
            $param['avatar'] = $array['avatar'];
        }
        if (isset($array['status']) && $array['status']) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->where('id', $array['id'])
                ->update($param);

            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'This user was updated ,successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Failure, Username Can not be update';
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL exception';
            $result->messageCode = 0;
        }

        return $result;
    }
}
