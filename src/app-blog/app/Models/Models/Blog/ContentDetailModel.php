<?php

namespace App\Models\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class ContentDetailModel extends Model
{

    /**
     * The table name
     */
    protected $table = 'blog_content_details';

    /**
     * The timestamps set to false
     */
    public $timestamps = false;

    protected $fillable = [
        'content_id',
        'detailable_id',
        'detailable_type',
        'status'
    ];

    /**
     * Define belongsTo relationship
     */
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'detailable_id', 'id')->withDefault();
    }

    public function tag()
    {
        return $this->belongsTo(TagModel::class, 'detailable_id', 'id')->withDefault();
    }


}
