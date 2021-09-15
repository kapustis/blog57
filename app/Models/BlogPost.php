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

//    protected $guarded = [
//        '_method',
//        '_token'
//    ];

    protected $fillable = [
        'blog_category_id', "user_id",'title', 'slug',
        'excerpt', 'content_raw','content_html',
        'is_published','published_at',

    ];

    /**
     * Категория поста
     * @return BelongsTo
     **/
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
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

    /**
     * @param array $comment
     * @return Model
     */
    public function addComment(array $comment): Model
    {
        $comment = $this->comments()->create($comment);
        // need add event
        return $comment;
    }

}
