<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;

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
     * Get your model for editing (in the admin area)
     * @param  $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Get a list of categories to display in the list
     * @return mixed
     */
    public function getCategoryList()
    {
        $fields = implode(', ',
            [
                'id',
                'CONCAT (id,". ",title) AS id_title',
            ]
        );

        $result = $this->startConditions()->selectRaw($fields)->toBase()->get();

        return $result;
    }

    /**
     * Get categories for display by paginator
     * @param null $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $fields = ['id', 'title', 'parent_id'];

        $result = $this->startConditions()
            ->with(['parentCategory:id,title'])
            ->paginate($perPage, $fields);

        return $result;
    }
}
