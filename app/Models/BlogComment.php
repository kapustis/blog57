<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $guarded = [
        '_method',
        '_token'
    ];

    protected $fillable = [
        "blog_post_id", "user_id", "content"
    ];

    /**
     * The relations to eager load on every query.
     * Отношения к нетерпеливой нагрузке на каждый запрос.
     * @var array
     */
    protected $with = ['owner'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blogpost(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogPost::class);
    }
    /**
     * Связь модели Comment с моделью Auth, позволяет получить
     * пользователя, который оставил комментарий
     */
    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
