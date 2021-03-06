<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //table info
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number','customer_id', 'staff_id','status','total'
    ];

    public function customer() {
        return $this->belongsTo(User::class, 'customer_id')->withTimestamps();
    }

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id')->withTimestamps();
    }

    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'payment_id');
    }
}
