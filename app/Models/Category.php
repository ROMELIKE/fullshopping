<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Business\resultObject;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use DB;

class Category extends Model
{
    //define some infomations.
    protected $table = 'category';
    protected $fillable
        = [
            'id',
            'name',
            'alias',
            'parent_id',
            'status'
        ];
    public $timestamps = false;

    //declare some relationship.

    //relationship with product: "1 category maybe have 1 or more product".
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    //--------------------------------------------------------------------------

    /**
     * Function: get the list of categories.
     *
     * @return resultObject
     */
    public function getCategoryList($orderBy = null)
    {
        $result = new resultObject;
        if (isset($orderBy) && $orderBy) {
            try {
                $sql = DB::table($this->table)->orderBy('date', $orderBy)->get()
                    ->toArray();
                if ($sql) {
                    $result->message = 'Thành công';
                    $result->messageCode = 1;
                    $result->result = $sql;
                } else {
                    $result->message = 'Thất bại';
                    $result->messageCode = 0;
                }
            } catch (Exception $exception) {
                $result->message = 'Sql exception';
                $result->messageCode = 0;
            }
        } else {
            try {
                $sql = DB::table($this->table)->get()->toArray();
                if ($sql) {
                    $result->message = 'Thành công';
                    $result->messageCode = 1;
                    $result->result = $sql;
                } else {
                    $result->message = 'Thất bại';
                    $result->messageCode = 0;
                }
            } catch (Exception $exception) {
                $result->message = 'Sql exception';
                $result->messageCode = 0;
            }
        }


        return $result;
    }


    /**
     * Function: get name'sCategory by id.
     *
     * @param $id
     *
     * @return resultObject
     */
    public function getCategoryById($id)
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
                $result->message = 'Thất bại';
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
     * Function: check the existion of a new category.
     *
     * @param $name
     *
     * @return resultObject
     */
    public function checkCategoryExist($name)
    {
        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->where('name', $name)->get();
            if (count($sql)) {
                $result->messageCode = 0;
                $result->message
                    = 'This Category have already been use, try again.';
            } else {
                $result->messageCode = 1;
                $result->message = 'This Category Can be use.';
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Check a category is parren_id ?
     *
     * @param $id
     *
     * @return resultObject
     */
    public function checkCategoryIsParrent($id)
    {
        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->where('parrent_id', $id)->get();
            if (count($sql)) {
                $result->messageCode = 0;
                $result->message
                    = 'This Category is parrent of other category';
            } else {
                $result->messageCode = 1;
                $result->message = 'This Category Can be deleted.';
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Add new category.
     *
     * @param $array
     *
     * @return resultObject
     */
    public function addNewCategory($array)
    {
        $param = [];
        if (isset($array['name']) && $array['name']) {
            $param['name'] = $array['name'];
        } else {
            $param['name'] = 'Unknow Cateogry';
        }
        if (isset($array['parrent_id']) && $array['parrent_id']) {
            $param['parrent_id'] = $array['parrent_id'];
        } else {
            $param['parrent_id'] = null;
        }
        if (isset($array['status']) && $array['status']) {
            $param['status'] = $array['status'];
        } else {
            $param['status'] = null;
        }
        if (isset($array['date']) && $array['date']) {
            $param['date'] = $array['date'];
        } else {
            $param['date'] = null;
        }
        if (isset($array['alias']) && $array['alias']) {
            $param['alias'] = $array['alias'];
        } else {
            $param['alias'] = null;
        }
        $result = new resultObject;
        try {
            $sql = DB::table($this->table)->insertGetId($param);
            if ($sql) {
                $result->message = 'Insert new category successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to insert new category!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = 'Sql exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Update a category.
     *
     * @param $array
     *
     * @return resultObject
     */
    public function upDateCategory($array)
    {
        $param = [];
        if (isset($array['name']) && $array['name']) {
            $param['name'] = $array['name'];
        }
        if (isset($array['parrent_id']) && $array['parrent_id']) {
            $param['parrent_id'] = $array['parrent_id'];
        }
        if (isset($array['status']) && $array['status']) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        if (isset($array['alias']) && $array['alias']) {
            $param['alias'] = $array['alias'];
        } else {
            $param['alias'] = null;
        }
        $result = new resultObject;
        try {
            $sql = DB::table($this->table)->where('id', $array['id'])
                ->update($param);
            if ($sql) {
                $result->message = 'Update new category successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to update new category!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = 'Sql exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: delete a category
     *
     * @param $id
     *
     * @return resultObject
     */
    public function deleteCategory($id)
    {
        $result = new resultObject;
        try {
            $sql = DB::table($this->table)->where('id', $id)->delete();
            if ($sql) {
                $result->message = 'Delete category successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Fail to delete category!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = 'Sql exception';
            $result->messageCode = 0;
        }

        return $result;
    }
}
