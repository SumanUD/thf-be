<?php

namespace Webkul\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\CMS\Contracts\Blog as BlogContract;

class Blog extends Model implements BlogContract
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'short_description',
        'content',
        'author',
        'reading_time',
        'status',
    ];
}
