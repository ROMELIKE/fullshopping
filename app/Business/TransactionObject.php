<?php
namespace App\Business;
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 4/6/2017
 * Time: 3:44 PM
 */
class TransactionObject
{
    //This class decides, the construct of basic User.
    //One return value of method, when call from controller, to model ussualy is object type
    public $id;
    public $user_id;
    public $status;
    public $amount;
    public $username;
    public $useremail;
    public $useraddress;
    public $userphone;
    public $created_at;
    public $update_at;
    public $message;
}
