<?php
/**
 * Class BlogPostRepository
 * @package App\Repositories
 */

namespace App\Repositories;

use App\Models\BlogPost as Model;

class BlogPostRepository extends CoreRepository
{

	protected function getModelClass()
	{
		// TODO: Implement getModelClass() method.\
		return Model::class;
	}
}
