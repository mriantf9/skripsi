<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Report extends Model
{
    //
    protected $fillable = [
        'user_id',
        'report_title',
        'customer_id',
        'graph_id',
        'created_at'
    ];

    // public function user()
    // {
    //     return $this->hasMany('App\User');
    // }
    // public function customer()
    // {
    //     return $this->hasMany('App\Customer');
    // }
    // public function graph()
    // {
    //     return $this->hasMany('App\Graph');
    // }
    // public function rrd()
    // {
    //     return $this->hasMany('App\Rrd');
    // }
}
