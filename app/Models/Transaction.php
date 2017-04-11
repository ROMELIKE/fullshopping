<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //define some infomations.
    protected $table = 'category';
    protected $fillable =[
        'id',
        'user_id',
        'date',
        'status',
        'amount',
        'username',
        'useremail',
        'useraddress',
        'userphone'
    ];
    public $timestamps = false;

    //declare some relationships.
    //"1 Transaction has many Order"
    public function Order(){
        return $this->hasMany('App\Models\Order');
    }
    //"1 Transaction belong to 1 User"
    public function User(){
        return $this->belongsTo('App\Models\User');
    }
    //--------------------------------------------------------------------------

}
