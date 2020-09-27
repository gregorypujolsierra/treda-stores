<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'store',
        'image',
    ];

    /**
     * Get the store
     *
     * @return BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
}
