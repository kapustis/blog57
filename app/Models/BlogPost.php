<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BlogPost
 *
 * @package App\Models
 *
 * @property \App\Models\BlogCategory $category
 * @property  string $title
 * @property  string $slug
 * @property  string $content_html
 * @property  string $content_raw
 * @property  string $excerpt
 * @property  string $published_at
 * @property  bool $is_published
 * @property  mixed $comments
 */
class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    const UNKNOWN_USER = 4;

//    protected $guarded = [
//        '_method',
//        '_token'
//    ];

    protected $fillable = [
        'title', 'slug', 'category_id',
        'content_html', 'content_raw', 'excerpt',
        'published_at', 'is_published',
    ];

    /**
     * Категория поста
     * @return BelongsTo
     **/
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * Автор
     * @return BelongsTo
     **/
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Linking the Post model to the Comment model allows you to get all the comments on the post
     *
     * Связь модели Post с моделью Comment, позволяет получить все комментарии к посту
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class);
    }

}
