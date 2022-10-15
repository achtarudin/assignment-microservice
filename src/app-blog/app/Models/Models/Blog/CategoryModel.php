<?php

namespace App\Models\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\Blog\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryModel extends Model
{
    use HasFactory;

    /**
     * The table name
     */
    protected $table = 'blog_categories';

    /**
     * The timestamps set to false
     */
    public $timestamps = false;

    /**
     * The Factory that should be used when creating new models
     */
    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

}
