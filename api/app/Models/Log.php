<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'action', 'model', 'model_id', 'data'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) use ($filters) {
            $query->where(function ($query) use ($search, $filters) {
                $query->where('action', 'like', '%' . $search . '%')
                    ->orWhere('model', 'like', '%' . $search . '%');
            });

            if (isset($filters['user_id'])) {
                $query->where('user_id', $filters['user_id']);
            }
        });

        $query->when($filters['user_id'] ?? null, function ($query, $user_id) use ($filters) {
            if (!isset($filters['search'])) {
                $query->where('user_id', $user_id);
            }
        });
    }
}
