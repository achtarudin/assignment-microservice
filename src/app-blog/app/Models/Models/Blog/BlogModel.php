<?php

namespace App\Models\Models\Blog;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Blog\BlogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogModel extends Model
{
    use HasFactory, SoftDeletes;

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
     * Define The Getters
     */
    public function getCreatedAtForHumanAttribute()
    {
        return $this->created_at ? Carbon::parse($this->created_at)->diffForHumans() : null;
    }

    public function getUpdatedAtForHumanAttribute()
    {
        return $this->updated_at ? Carbon::parse($this->updated_at)->diffForHumans() : null;
    }

    /**
     * Define belongsTo relationship
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withDefault();
    }

    /**
     * Define hasMany relationship
     */
    public function content_details()
    {
        return $this->hasMany(ContentDetailModel::class, 'content_id');
    }

    public function tag_details()
    {
        return $this->hasMany(ContentDetailModel::class, 'content_id');
    }

    public function category_details()
    {
        return $this->hasMany(ContentDetailModel::class, 'content_id');
    }
}
