<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rrd extends Model
{
    //
    protected $fillable = [
        'rrd_name',
        'report_id',
        'created_at',
        'updated_at'
    ];
}
