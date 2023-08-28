<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_name',
        'description',
        'link',
        'prefix',
        'size_image',
        'main_image',
        'size_chart_image',
        'replace_size_image',
        'image',
        'created_at'
    ];
}
