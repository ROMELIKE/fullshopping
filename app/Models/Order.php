<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //define some infomations.
    protected $table = 'order';
    protected $fillable
        = [
            'id',
            'transaction_id',
            'product_id',
            'quantity',
            'amount',
            'status',
            'data'
        ];
    public $timestamps = false;

    //declare some relationship.

    //relationship with product "1 order belong to 1 product"
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    //relationship with transaction "1 order belong to 1 transaction"
    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }
    //--------------------------------------------------------------------------

}
