<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_group'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orderStaff() {
        return $this->hasMany(Order::class, 'staff_id')->withTimestamps();
    }

    public function orderCustomer() {
        return $this->hasMany(Order::class, 'customer_id')->withTimestamps();
    }

    public function staff() {
        return $this->hasOne(Staff::class, 'user_id');
    }

    public function customer() {
        return $this->hasOne(Customer::class, 'user_id');
    }

    public function payment(){
        return $this->hasMany(User::class,'customer_id');
    }
}
