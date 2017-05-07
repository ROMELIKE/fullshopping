<?php
namespace App\Business;
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 4/6/2017
 * Time: 3:44 PM
 */
class OrderObject
{
    //This class decides, the construct of basic Order.
    //One return value of method, when call from controller, to model ussualy is object type
    public $id;
    public $transaction_id;
    public $product_id;
    public $quantity;
    public $amount;
    public $status;
    public $data;
    public $created_at;
    public $update_at;
}
