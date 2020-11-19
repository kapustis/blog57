<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
	use SoftDeletes;

	/**
	 * Категория поста
	 * @return BelongsTo
	 **/
	public function category()
	{
		return $this->belongsTo(BlogCategory::class,'category_id');
	}

	/**
	 * Автор
	 * @return BelongsTo
	 **/
	public function creator()
	{
		return $this->belongsTo(User::class, 'user_id');
	}


}
