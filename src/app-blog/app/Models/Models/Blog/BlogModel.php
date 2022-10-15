<?php

namespace App\Models\Models\Blog;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Blog\BlogFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogModel extends Model
{
    use HasFactory;

    /**
     * The table name
     */
    protected $table = 'blog_contents';

    /**
     * The timestamps set to false
     */
    public $timestamps = false;

    /**
     * The Factory that should be used when creating new models
     */
    protected static function newFactory()
    {
        return BlogFactory::new();
    }

    /**
     * Define belongsTo relationship
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withDefault();
    }

    /**
     * Difine The Getters
     */
    public function getCreatedAtForHumanAttribute(){
        return $this->created_at ? Carbon::parse($this->created_at)->diffForHumans() : null;
    }

    public function getUpdatedAtForHumanAttribute()
    {
        return $this->updated_at ? Carbon::parse($this->updated_at)->diffForHumans() : null;
    }
}
