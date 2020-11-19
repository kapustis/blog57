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
		$posts = $this->blogPostRepository->getAllWithPaginate(20);
//		dd($posts);
		return view('blog.admin.posts.index',compact('posts'));
	}

	public function create(){
		dd(__METHOD__);
	}
	public function edit($id){
		dd(__METHOD__,$id);
	}

}
