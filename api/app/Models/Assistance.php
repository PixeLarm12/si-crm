<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    protected $table = 'assistances';

    protected $fillable = [
        'opened_by',
        'admin_id',
        'type',
        'subject',
        'message',
        'open_date',
        'close_date',
        'status',
    ];
}
