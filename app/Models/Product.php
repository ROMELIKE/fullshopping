<?php

namespace App\Models;

use App\Business\resultObject;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    //define some infomations.
    protected $table = 'product';
    protected $fillable
        = [
            'id',
            'cate_id',
            'alias',
            'name',
            'desciption',
            'image',
            'status',
            'count',
            'date',
            'price',
            'listimg'
        ];
    public $timestamps = false;

    //declare some relationship.

    //relationship with Category.
    //"1 Product belong to 1 Category".
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    //"1 product has many Order"
    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    //--------------------------------------------------------------------------

    /**
     * Function: Insert product.
     *
     * @param $array
     *
     * @return resultObject
     */
    public function addProduct($array)
    {
        $param = [];
        if (isset($array['name']) && $array['name']) {
            $param['name'] = $array['name'];
        } else {
            $param['name'] = 'Unknow';
        }
        if (isset($array['price']) && $array['price']) {
            $param['price'] = $array['price'];
        } else {
            $param['price'] = null;
        }
        if (isset($array['count']) && $array['count']) {
            $param['count'] = $array['count'];
        } else {
            $param['count'] = 0;
        }
        if (isset($array['discount']) && $array['discount']) {
            $param['discount'] = $array['discount'];
        } else {
            $param['discount'] = null;
        }
        if (isset($array['cate_id']) && $array['cate_id']) {
            $param['cate_id'] = $array['cate_id'];
        } else {
            $param['cate_id'] = null;
        }
        if (isset($array['description']) && $array['description']) {
            $param['desciption'] = $array['description'];
        } else {
            $param['desciption'] = null;
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
        if (isset($array['thumbnail']) && $array['thumbnail']) {
            $param['image'] = $array['thumbnail'];
        } else {
            $param['image'] = 'unknow.jpg';
        }
        if (isset($array['listimg']) && $array['listimg']) {
            $param['listimg'] = $array['listimg'];
        } else {
            $param['listimg'] = null;
        }
        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->insertGetId($param);
            if ($sql) {
                $result->messageCode = 1;
                $result->message
                    = 'Insert Product successfully';
            } else {
                $result->messageCode = 0;
                $result->message = 'Failure,Can not insert Product';
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: get Product List.
     *
     * @param string $orderBy
     *
     * @return resultObject
     */
    public function getProductList($orderBy = 'ASC')
    {
        $result = new resultObject();

        try {
            $sql = DB::table($this->table)->orderBy('date', $orderBy)->get()
                ->toArray();
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Get ProductList successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Failure,Can not get ProductList';
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    public function getNewProductList($orderBy = 'ASC', $take = 0)
    {
        $result = new resultObject();

        if ($take) {
            try {
                $sql = DB::table($this->table)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)
                    ->take($take)->get()
                    ->toArray();
                if ($sql) {
                    $result->messageCode = 1;
                    $result->message = 'Get ProductList successfully';
                    $result->result = $sql;
                } else {
                    $result->messageCode = 0;
                    $result->message = 'Failure,Can not get ProductList';
                }
            } catch (\Exception $exception) {
                $result->message = 'SQL exception';
                $result->messageCode = 0;
            }
        } else {
            try {
                $sql = DB::table($this->table)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)->get()
                    ->toArray();
                if ($sql) {
                    $result->messageCode = 1;
                    $result->message = 'Get ProductList successfully';
                    $result->result = $sql;
                } else {
                    $result->messageCode = 0;
                    $result->message = 'Failure,Can not get ProductList';
                }
            } catch (\Exception $exception) {
                $result->message = 'SQL exception';
                $result->messageCode = 0;
            }
        }

        return $result;
    }


    public function getDiscountProductList($orderBy = 'ASC', $take = 0)
    {
        $result = new resultObject();

        if ($take) {
            try {
                $sql = DB::table($this->table)->where('discount', '>', 0)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)
                    ->take($take)->get()
                    ->toArray();
                if ($sql) {
                    $result->messageCode = 1;
                    $result->message = 'Get ProductList successfully';
                    $result->result = $sql;
                } else {
                    $result->messageCode = 0;
                    $result->message = 'Failure,Can not get ProductList';
                }
            } catch (\Exception $exception) {
                $result->message = 'SQL exception';
                $result->messageCode = 0;
            }
        } else {
            try {
                $sql = DB::table($this->table)->where('discount', '>', 0)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)->get()
                    ->toArray();
                if ($sql) {
                    $result->messageCode = 1;
                    $result->message = 'Get ProductList successfully';
                    $result->result = $sql;
                } else {
                    $result->messageCode = 0;
                    $result->message = 'Failure,Can not get ProductList';
                }
            } catch (\Exception $exception) {
                $result->message = 'SQL exception';
                $result->messageCode = 0;
            }
        }

        return $result;
    }


    /**
     * Function: get product by id
     *
     * @param $id
     *
     * @return resultObject
     */
    public function getProductById($id)
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
     * Function: Update Product.
     *
     * @param $array
     *
     * @return resultObject
     */
    public function updateProduct($array)
    {
        $param = [];
        if (isset($array['name']) && $array['name']) {
            $param['name'] = $array['name'];
        }
        if (isset($array['alias']) && $array['alias']) {
            $param['alias'] = $array['alias'];
        }
        if (isset($array['price']) && $array['price']) {
            $param['price'] = $array['price'];
        }
        if (isset($array['discount']) && $array['discount']) {
            $param['discount'] = $array['discount'];
        }
        if (isset($array['count']) && $array['count']) {
            $param['count'] = $array['count'];
        }
        if (isset($array['cate_id']) && $array['cate_id']) {
            $param['cate_id'] = $array['cate_id'];
        }
        if (isset($array['desciption']) && $array['desciption']) {
            $param['desciption'] = $array['desciption'];
        }
        if (isset($array['thumbnail']) && $array['thumbnail']) {
            $param['image'] = $array['thumbnail'];
        }
        if (isset($array['listimg']) && $array['listimg']) {
            $param['listimg'] = $array['listimg'];
        }
        if (isset($array['status']) && $array['status']) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }

        $id = $array['id'];
        $result = new resultObject();
        try {
            $sql = DB::table($this->table)->where('id', $id)->update($param);
            if ($sql) {
                $result->messageCode = 1;
                $result->message
                    = 'Update Product successfully';
            } else {
                $result->messageCode = 0;
                $result->message = 'Do not modify any thing';
            }
        } catch (\Exception $exception) {
            $result->message = 'SQL exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Delete Product.
     *
     * @param $id
     *
     * @return resultObject
     */
    public function deleteProduct($id)
    {
        $result = new resultObject;
        try {
            $sql = DB::table($this->table)->where('id', $id)->delete();
            if ($sql) {
                $result->message = 'Delete Product successfully!';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'Delete Product Failure!';
                $result->messageCode = 0;
            }
        } catch (Exception $exception) {
            $result->message = 'Sql exception';
            $result->messageCode = 0;
        }

        return $result;
    }

    public function getRelatedProductList(
        $id,
        $cate_id,
        $orderBy = 'ASC',
        $take = 9
    ) {
        $result = new resultObject;
        try {
            $sql = DB::table('product')
                ->where('cate_id', $cate_id)
                ->where('id', '<>', $id)
                ->orderBy('date', $orderBy)
                ->take($take)
                ->get();
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
}
