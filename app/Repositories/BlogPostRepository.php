<?php
/**
 * Class BlogPostRepository
 * @package App\Repositories
 */

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{
	/**
	 * @return string
	 */
	protected function getModelClass()
	{
		// TODO: Implement getModelClass() method.\
		return Model::class;
	}

	/**
	 * @param null $perPage
	 * @return LengthAwarePaginator
	 * */
	public function getAllWithPaginate($perPage = null)
	{
		$fields = [
			'id', 'title', 'slug', 'category_id',
			'user_id', 'is_published', 'published_at'
		];

		$res = $this->startConditions()
			->select($fields)
			->orderBy('id', 'DESC')
			->with(['category:id,title,slug', 'creator:id,name'])
			->paginate($perPage);
//			->get()->first();
//		dd($res);
		return $res;
	}
}
