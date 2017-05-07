<?php
namespace App\Business;
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 4/6/2017
 * Time: 3:44 PM
 */
class ProductObject
{
    //This class decides, the construct of basic Product.
    //One return value of method, when call from controller, to model ussualy is object type
    public $id;
    public $cate_id;
    public $alias;
    public $name;
    public $desciption;
    public $image;
    public $status;
    public $count;
    public $date;
    public $price;
    public $listimg;
    public $discount;
    public $shorttext;
}
