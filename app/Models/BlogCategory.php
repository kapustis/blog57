<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogCategory
 * @package App\Models
 *
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
    use HasFactory,SoftDeletes;

    const ROOT_ID = 1;

    protected $fillable = ['parent_id', 'title', 'slug', 'description'];


    public function posts(){
        return $this->hasMany(BlogPost::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Accessor
     * @return string
     */
    public function getParentTitleAttribute(): string
    {
        $title = $this->parentCategory->title ?? ($this->isRoot() ? 'Корень!' : 'Косячная категория???');

        return $title;
    }

    /**
     * Whether the current object is root
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->id === BlogCategory::ROOT_ID;
    }

}
