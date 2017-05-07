<?php
namespace App\Business;

/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 4/6/2017
 * Time: 3:44 PM
 */
class UserObject
{
    //This class decides, the construct of basic UserObject.
    //One return value of method, when call from controller, to model ussualy is object type
    public $id;
    public $name;
    public $email;
    public $username;
    public $password;
    public $status;
    public $avatar;
    public $accessible;
    public $phone;
    public $address;
    public $remember_token;
    public $date;
}
