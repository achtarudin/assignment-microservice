<?php

namespace App\Models\Models\Blog;

use Database\Factories\Blog\TagFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagModel extends Model
{
    use HasFactory;

    /**
     * The table name
     */
    protected $table = 'blog_tags';

    /**
     * The timestamps set to false
     */
    public $timestamps = false;

    /**
     * The Factory that should be used when creating new models
     */
    protected static function newFactory()
    {
        return TagFactory::new();
    }
}
