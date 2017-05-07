<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Business\ResultObject;
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
     * Function: Get the list of categories.
     *
     * @return ResultObject
     */
    public function getCategoryList($orderBy = null)
    {
        $result = new ResultObject;
        if (isset($orderBy) && $orderBy) {
            try {
                $sql = DB::table($this->table)->orderBy('date', $orderBy)->paginate(8);
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
        } else {
            try {
                $sql = DB::table($this->table)->orderBy('date','DESC')->paginate(10);
                if ($sql) {
                    $result->message = 'Successfully';
                    $result->messageCode = 1;
                    $result->result = $sql;
                } else {
                    $result->message = 'Error';
                    $result->messageCode = 0;
                }
            } catch (Exception $exception) {
                $result->message = $exception->getMessage();
                $result->messageCode = 0;
            }
        }

        return $result;
    }

    /**
     * Function: Get the list of menu level 1.
     *
     * @return ResultObject
     */
    public function getMenuLevel1List()
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('parrent_id', 0)
                ->where('status', '>', 0)->get()->toArray();
            if ($sql) {
                $result->message = 'Thành công';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Thất bại';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: get name'sCategory by id.
     *
     * @param $id
     *
     * @return ResultObject
     */
    public function getCategoryById($id)
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

    /**
     * Function: get the list of category, have general parrent_id.
     * @param $id
     *
     * @return ResultObject
     */
    public function getCategoryByParrentId($id)
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('parrent_id', $id)
                ->where('status', '>', 0)->get()
                ->toArray();
            if ($sql) {
                $result->message = 'Successfully!';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'Failure!';
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
     * Function: check the existion of a new category.
     *
     * @param $name
     *
     * @return ResultObject
     */
    public function checkCategoryExist($name)
    {
        $result = new ResultObject();
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Check a category is parren_id ?,
     * Purpose: check before delete category
     *
     * @param $id
     *
     * @return ResultObject
     */
    public function checkCategoryIsParrent($id)
    {
        $result = new ResultObject();
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Add new category.
     *
     * @param $array
     *
     * @return ResultObject
     */
    public function addNewCategory($category)
    {
        $param = [];
        if (isset($category->name) && $category->name) {
            $param['name'] = $category->name;
        } else {
            $param['name'] = 'Unknow Cateogry';
        }
        if (isset($category->parrent_id) && $category->parrent_id) {
            $param['parrent_id'] = $category->parrent_id;
        } else {
            $param['parrent_id'] = 0;
        }
        if (isset($category->status) && $category->status) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        if (isset($category->date) && $category->date) {
            $param['date'] = $category->date;
        } else {
            $param['date'] = null;
        }
        if (isset($category->alias) && $category->alias) {
            $param['alias'] = $category->alias;
        } else {
            $param['alias'] = null;
        }
        $result = new ResultObject;
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Update a category.
     *
     * @param $array
     *
     * @return ResultObject
     */
    public function upDateCategory($category)
    {
        $param = [];
        if (isset($category->name) && $category->name) {
            $param['name'] = $category->name;
        }
        if (isset($category->parrent_id) && $category->parrent_id) {
            $param['parrent_id'] = $category->parrent_id;
        }
        if (isset($category->status) && $category->status) {
            $param['status'] = 1;
        }else{
            $param['status'] = 0;
        }
        if (isset($category->alias) && $category->alias) {
            $param['alias'] = $category->alias;
        }
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)->where('id', $category->id)
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: delete a category
     *
     * @param $id
     *
     * @return ResultObject
     */
    public function deleteCategory($id)
    {
        $result = new ResultObject;
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    public function getProductByCateId($id)
    {
        $result = new ResultObject;
        try {
            $sql = DB::table('product')->where('cate_id', $id)->get()->toArray();
            if ($sql) {
                $result->message = 'find successfully!!';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'Fail to find category!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }
}
