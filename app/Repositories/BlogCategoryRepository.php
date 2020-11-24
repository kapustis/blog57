<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;

//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 **/
class BlogCategoryRepository extends CoreRepository
{
	/**
	 * @return string
	 */
	protected function getModelClass()
	{
		return Model::class;
	}

	/**
	 *  Получить модель для редактирования в админке
	 * @param  $id
	 * @return Model
	 */
	public function getEdit($id)
	{
		return $this->startConditions()->find($id);
	}

	/**
	 *  Получить список категорий для вывода в выпадающем списке
	 * @return Collection
	 */
	public function getForComboBox()
	{
//		return $this->startConditions()->all();
//		$res[] = $this->startConditions()
//			->select('blog_categories.*',
//				\DB::raw('CONCAT (id,". ",title) AS id_title'))
//			->toBase()
//			->get();

		$fields = implode(', ', [
			'id',
			'CONCAT (id,". ",title) AS id_title',
		]);

		$res = $this->startConditions()->selectRaw($fields)->toBase()->get();

		return $res;
	}

	/**
	 * Получить категории для вывода пагинатором
	 * @param null $perPage
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAllWithPaginate($perPage = null)
	{
		$fields = ['id', 'title', 'parent_id'];
		$res = $this->startConditions()
			->with(['parentCategory:id,title'])
			->paginate($perPage, $fields);
//			->select($fields)
//			->paginate($perPage);

		return $res;
	}
}
