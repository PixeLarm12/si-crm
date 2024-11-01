<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'user_id',
        'total_price',
        'date',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
