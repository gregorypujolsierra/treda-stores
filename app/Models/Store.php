<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'opened_since',
    ];

    /**
     * Get the products
     *
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
