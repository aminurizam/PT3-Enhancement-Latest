<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //table info
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'quantity'
    ];

    public function order() {
        return $this->belongsTo(Order::class, 'order_id')->withTimestamps();
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
