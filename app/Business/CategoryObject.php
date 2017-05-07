<?php
namespace App\Business;

/**
 * Created  by PhpStorm.
 * User: ROME
 * Date: 4/6/2017
 * Time: 3:44 PM
 */
class CategoryObject
{
    //This class decides, the construct of basic Category.
    //One return value of method, when call from controller, to model ussualy is object type
    public $id;
    public $name;
    public $alias;
    public $parrent_id;
    public $status;
    public $date;
}
