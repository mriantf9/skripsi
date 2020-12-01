<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'customer_name',
        'customer_email'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
