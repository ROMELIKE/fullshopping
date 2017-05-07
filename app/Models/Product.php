<?php

namespace App\Models;

use App\Business\ResultObject;
use Illuminate\Database\Eloquent\Model;
use DB, Cart;

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
     * @return ResultObject
     */
    public function addProduct($product)
    {
        $param = [];
        if (isset($product->name) && $product->name) {
            $param['name'] = $product->name;
        } else {
            $param['name'] = 'Unknow';
        }
        if (isset($product->price) && $product->price) {
            $param['price'] = $product->price;
        } else {
            $param['price'] = null;
        }
        if (isset($product->count) && $product->count) {
            $param['count'] = $product->count;
        } else {
            $param['count'] = 0;
        }
        if (isset($product->discount) && $product->discount) {
            $param['discount'] = $product->discount;
        } else {
            $param['discount'] = null;
        }
        if (isset($product->cate_id) && $product->cate_id) {
            $param['cate_id'] = $product->cate_id;
        } else {
            $param['cate_id'] = null;
        }
        if (isset($product->desciption) && $product->desciption) {
            $param['desciption'] = $product->desciption;
        } else {
            $param['desciption'] = null;
        }
        if (isset($product->date) && $product->date) {
            $param['date'] = $product->date;
        } else {
            $param['date'] = null;
        }
        if (isset($product->status) && $product->status) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        if (isset($product->image) && $product->image) {
            $param['image'] = $product->image;
        } else {
            $param['image'] = 'unknow.jpg';
        }
        if (isset($product->listimg) && $product->listimg) {
            $param['listimg'] = $product->listimg;
        } else {
            $param['listimg'] = null;
        }
        $result = new ResultObject();
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: get Product List.
     *
     * @param string $orderBy
     *
     * @return ResultObject
     */
    public function getProductList($orderBy = 'DESC')
    {
        $result = new ResultObject();

        try {
            $sql = DB::table($this->table)->orderBy('date', $orderBy)->paginate(6);
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Get ProductList successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Failure,Can not get ProductList';
            }
        } catch (\Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * @param string $orderBy
     * @param int    $take
     *
     * @return ResultObject
     */
    public function getListLastestProduct($orderBy = 'ASC', $take = 0)
    {
        $result = new ResultObject();
        try {
            if ($take) {
                $sql = DB::table($this->table)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)
                    ->take($take)->paginate(12);
            } else {
                $sql = DB::table($this->table)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)->paginate(12);
            }
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Get ProductList successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Failure,Can not get ProductList';
            }
        } catch (\Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * @param string $orderBy
     * @param int    $take
     *
     * @return ResultObject
     */
    public function getListDiscountProduct($orderBy = 'ASC', $take = 0)
    {
        $result = new ResultObject();
        try {
            if ($take) {
                $sql = DB::table($this->table)->where('discount', '>', 0)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)
                    ->take($take)->paginate(12);
            } else {
                $sql = DB::table($this->table)->where('discount', '>', 0)
                    ->where('status', '>', 0)
                    ->orderBy('date', $orderBy)->paginate(12);
            }
            if ($sql) {
                $result->messageCode = 1;
                $result->message = 'Get ProductList successfully';
                $result->result = $sql;
            } else {
                $result->messageCode = 0;
                $result->message = 'Failure,Can not get ProductList';
            }
        } catch (\Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }


    /**
     * Function: get product by id
     *
     * @param $id
     *
     * @return ResultObject
     */
    public function getProductById($id)
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
                $result->message = 'Thất bại';
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
     * Function: Update Product.
     *
     * @param $array
     *
     * @return ResultObject
     */
    public function updateProduct($product)
    {
        $param = [];
        if (isset($product->name) && $product->name) {
            $param['name'] = $product->name;
        }
        if (isset($product->alias) && $product->alias) {
            $param['alias'] = $product->alias;
        }
        if (isset($product->price) && $product->price) {
            $param['price'] = $product->price;
        }
        if (isset($product->discount) && $product->discount) {
            $param['discount'] = $product->discount;
        }
        if (isset($product->count) && $product->count) {
            $param['count'] = $product->count;
        }
        if (isset($product->cate_id) && $product->cate_id) {
            $param['cate_id'] = $product->cate_id;
        }
        if (isset($product->desciption) && $product->desciption) {
            $param['desciption'] = $product->desciption;
        }
        if (isset($product->image) && $product->image) {
            $param['image'] = $product->image;
        }
        if (isset($product->listimg) && $product->listimg) {
            $param['listimg'] = $product->listimg;
        }
        if (isset($product->status) && ($product->status)) {
            $param['status'] = 1;
        } else {
            $param['status'] = 0;
        }
        $id = $product->id;

        $result = new ResultObject();
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    /**
     * Function: Delete Product.
     *
     * @param $id
     *
     * @return ResultObject
     */
    public function deleteProduct($id)
    {
        $result = new ResultObject;
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
            $result->message = $exception->getMessage();
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
        $result = new ResultObject;
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
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
            $result->numberOfResult = 0;
        }

        return $result;
    }

    public function handleImage($image, $path)
    {

    }

    public function getListProductsByCategoryId($id)
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)
                ->where('cate_id', $id)
                ->paginate(12);
            if ($sql) {
                $result->message = 'successfully';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'failure';
                $result->messageCode = 0;
                $result->numberOfResult = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    public function getListPopularProduct()
    {
        $result = new ResultObject;
        try {
            $sql = DB::table($this->table)
                ->where('cate_id', $id)
                ->get()->toArray();
            if ($sql) {
                $result->message = 'successfully';
                $result->messageCode = 1;
                $result->result = $sql;
                $result->numberOfResult = count($sql);
            } else {
                $result->message = 'failure';
                $result->messageCode = 0;
                $result->numberOfResult = 0;
            }
        } catch (Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

    //CART
    public function cartAdd($product, $qty, $array = null)
    {
        $result = new ResultObject;
        try {
            $sql = Cart::add([

                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $qty,
                    'price' => $product->price,
                    'options' => $array
                ]
            );
            if ($sql) {
                $result->message = 'successfully';
                $result->messageCode = 1;
                $result->result = $sql;
            } else {
                $result->message = 'failure';
                $result->messageCode = 0;
            }
        } catch (\Exception $exception) {
            $result->message = $exception->getMessage();
            $result->messageCode = 0;
        }

        return $result;
    }

}
