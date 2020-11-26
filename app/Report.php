<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
