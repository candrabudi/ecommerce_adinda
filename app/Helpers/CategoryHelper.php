<?php

namespace App\Helpers;

use App\Models\Category;

class CategoryHelper
{
    public static function getCategories()
    {
        return Category::with('children')->whereNull('parent_id')->get();
    }
}
