<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\CMS\Contracts\Recipe as RecipeContract;

class Recipe extends Model implements RecipeContract
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'description',
        'prep_time',
        'cook_time',
        'servings',
        'difficulty',
        'ingredients',
        'instructions',
        'status',
    ];

    protected $casts = [
        'ingredients'  => 'json',
        'instructions' => 'json',
    ];
}
