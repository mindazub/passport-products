<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'price',
    ];

    protected $casts = [
        'title' => 'string',
        'price' => 'float',
    ]
}
