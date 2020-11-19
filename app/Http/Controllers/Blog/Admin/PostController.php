<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

use App\Repositories\BlogPostRepository;

class PostController extends BaseController
{

	/** @var BlogPostRepository * */
	private $blogPostRepository;

	/** postController constructor **/
	public function __construct()
	{
		parent::__construct();
		$this->blogPostRepository = app(BlogPostRepository::class);
	}

	/**
	 * @return Factory|Application|Response|View
	 */
	public function index()
	{
		return view('blog.admin.posts.index');
	}

}
