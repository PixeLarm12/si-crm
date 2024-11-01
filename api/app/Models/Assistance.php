<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function openedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'opened_by');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
