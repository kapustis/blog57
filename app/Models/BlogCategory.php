<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string slug
 * @property string title
 * @property string description
 * @property int parent_id
 * @property-read BlogCategory $parentCategory
 * @property-read string $parentTitle
 */
class BlogCategory extends Model
{
    use SoftDeletes;

    const ROOT_ID = 1;
    protected $fillable = ['parent_id', 'title', 'slug', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**Accessor
     * @return string
     */
    public function getParentTitleAttribute()
    {
        $title = $this->parentCategory()->title ?? (1 ? 'Корень' : '???');
        return $title;
    }

//    public function isRoot()
//    {
//        return $this->id === BlogCategory::ROOT_ID;
//    }

}
