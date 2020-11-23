<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
	/**
	 * если нет даты публикации ,а происходит установка флага -> Опубликовано
	 * то устанавливаем текущую дату в поле published_at
	 * @param BlogPost $blogPost
	 */
	protected function setPublishedAt(BlogPost $blogPost)
	{
		if (empty($blogPost->published_at) && $blogPost->is_published) {
			$blogPost->published_at = Carbon::now();
		}
	}

	/**
	 * Если slug поля нет то генирируем с title
	 * @param BlogPost $blogPost
	 */
	protected function setSlug(BlogPost $blogPost)
	{
		if (empty($blogPost->slug)) {
			$blogPost->slug = Str::slug($blogPost->title);
		}
	}


	/**
	 * Handle the blog post "created" event.
	 * оброботка ДО создания записи
	 * @param \App\Models\BlogPost $blogPost
	 * @return void
	 */
	public function created(BlogPost $blogPost)
	{
		$this->setPublishedAt($blogPost);
		$this->setSlug($blogPost);
	}

	/**
	 * Handle the blog post "updating" event.
	 * обработка ДО обновления записи
	 * @param \App\Models\BlogPost $blogPost
	 * @return void
	 */
	public function updating(BlogPost $blogPost)
	{
//		$test[] = $blogPost->isDirty();
//		$test[] = $blogPost->isDirty('is_published');
//		$test[] = $blogPost->getAttribute('is_published');
//		$test[] = $blogPost->is_published;
//		$test[] = $blogPost->getOriginal('is_published');
//		dd($test);

		$this->setPublishedAt($blogPost);
		$this->setSlug($blogPost);
	}

	/**
	 * Handle the blog post "updated" event.
	 * обработка ПОСЛЕ обновления записи
	 * @param \App\Models\BlogPost $blogPost
	 * @return void
	 */
	public function updated(BlogPost $blogPost)
	{
		//
	}

	/**
	 * Handle the blog post "deleted" event.
	 *
	 * @param \App\Models\BlogPost $blogPost
	 * @return void
	 */
	public function deleted(BlogPost $blogPost)
	{
		//
	}

	/**
	 * Handle the blog post "restored" event.
	 *
	 * @param \App\Models\BlogPost $blogPost
	 * @return void
	 */
	public function restored(BlogPost $blogPost)
	{
		//
	}

	/**
	 * Handle the blog post "force deleted" event.
	 *
	 * @param \App\Models\BlogPost $blogPost
	 * @return void
	 */
	public function forceDeleted(BlogPost $blogPost)
	{
		//
	}

}
