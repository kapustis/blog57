<?php
/**
 * Class BlogPostRepository
 * @package App\Repositories
 */

namespace App\Repositories;

use App\Models\BlogPost as Model;


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
     * get a list of articles to display in the list (Admin)
     * @param null $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
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

    /**
     * @param $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
