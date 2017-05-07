<?php

namespace App\Models;

use App\Business\ResultObject;
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
    public function AddNewUser($user)
    {
        $param = [];
        if (isset($user->name) && $user->name) {
            $param['name'] = $user->name;
        } else {
            $param['name'] = 'Unknow User';
        }
        if (isset($user->username) && $user->username) {
            $param['username'] = $user->username;
        } else {
            $param['username'] = null;
        }
        if (isset($user->email) && $user->email) {
            $param['email'] = $user->email;
        } else {
            $param['email'] = null;
        }
        if (isset($user->password) && $user->password) {
            $param['password'] = $user->password;
        } else {
            $param['password'] = null;
        }
        if (isset($user->accessible) && $user->accessible) {
            $param['accessible'] = $user->accessible;
        } else {
            $param['accessible'] = 0;
        }
        if (isset($user->phone) && $user->phone) {
            $param['phone'] = $user->phone;
        } else {
            $param['phone'] = null;
        }
        if (isset($user->address) && $user->address) {
            $param['address'] = $user->address;
        } else {
            $param['address'] = null;
        }
        if (isset($user->avatar) && $user->avatar) {
            $param['avatar'] = $user->avatar;
        } else {
            $param['avatar'] = null;
        }
        if (isset($user->date) && $user->date) {
            $param['date'] = $user->date;
        } else {
            $param['date'] = null;
        }
        if (isset($user->status) && $user->status) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }

        $result = new ResultObject();
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
            $result->message = $exception->getMessage();
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
     * @return ResultObject
     */
    public function getListUser($orderBy = 'DESC', $access = '0')
    {
        $result = new ResultObject();
        //if i want to get list Addmin.
        try {
            if ($access == 'admin') {
                $sql = DB::table($this->table)->where('accessible', '!=', 0)
                    ->orderBy('date', $orderBy)->paginate(6);
            } else {
                //if i want to get list SimpleUser.
                $sql = DB::table($this->table)->where('accessible', $access)
                    ->orderBy('date', $orderBy)->paginate(6);
            }
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }
        return $result;
    }

    /**
     * Function: Delete User
     *
     * @param $id
     *
     * @return ResultObject
     */
    public function deleteUser($id)
    {
        $result = new ResultObject();
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: get user by id
     *
     * @param $id
     *
     * @return ResultObject
     */
    public function getUserById($id)
    {
        $result = new ResultObject;
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
            $result->numberOfResult = 0;
        }

        return $result;
    }

    /**
     * Function:check 'username' is exist?
     *
     * @param $name
     *
     * @return ResultObject
     */
    public function checkUsernameExist($name)
    {
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('username', $name)->get();
            if (count($sql)) {
                $result->messageCode = 0;
                $result->message
                    = 'This Username have already been use, try again.';
            } else {
                $result->messageCode = 1;
                $result->message = 'This Username Can be use.';
            }
        } catch (\Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Update User.
     *
     * @param $array
     *
     * @return ResultObject
     */
    public function updateUser($user)
    {
        $param = [];
        if (isset($user->name) && $user->name) {
            $param['name'] = $user->name;
        }
        if (isset($user->username) && $user->username) {
            $param['username'] = $user->username;
        }
        if (isset($user->address) && $user->address) {
            $param['address'] = $user->address;
        }
        if (isset($user->email) && $user->email) {
            $param['email'] = $user->email;
        }
        if (isset($user->phone) && $user->phone) {
            $param['phone'] = $user->phone;
        }
        if (isset($user->avatar) && $user->avatar) {
            $param['avatar'] = $user->avatar;
        }
        if (isset($user->accessible) && $user->accessible) {
            $param['accessible'] = $user->accessible;
        }
        if (isset($user->date) && $user->date) {
            $param['date'] = $user->date;
        }
        if (isset($user->password) && $user->password) {
            $param['password'] = $user->password;
        }
        if (isset($user->status) && $user->status) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        $result = new ResultObject();
        try {
            $sql = DB::table($this->table)->where('id', $user->id)
                ->update($param);

            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'This user was updated ,successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Nothing was updated';
            }
        } catch (\Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }
}
