<?php
namespace App\Business;
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 4/6/2017
 * Time: 3:44 PM
 */
class resultObject
{
    public $message;
    public $messageCode;
    public $numberOfResult;
    public $result;
}
class Message {

    const GENERAL_ERROR = 0;

    const SUCCESS = 1;
}