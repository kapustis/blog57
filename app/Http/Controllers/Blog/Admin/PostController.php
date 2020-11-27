<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends BaseController
{

	/** @var BlogPostRepository * */
	private $blogPostRepository;
	/** @var  BlogCategoryRepository * */
	private $blogCategoryRepository;

	/** postController constructor **/
	public function __construct()
	{
		parent::__construct();
		$this->blogPostRepository = app(BlogPostRepository::class);
		$this->blogCategoryRepository = app(BlogCategoryRepository::class);
	}

	/**
	 * @return Application|Factory|View
	 */
	public function index()
	{
		$posts = $this->blogPostRepository->getAllWithPaginate(25);
		return view('blog.admin.posts.index', compact('posts'));
	}

	/**
	 * @return Application|Factory|View
	 */
	public function create()
	{
		$item = BlogPost::make();
		$catList = $this->blogCategoryRepository->getForComboBox();
		return view('blog.admin.posts.edit', compact('item', 'catList'));
	}

	public function store(BlogPostCreateRequest $request)
	{
		$data = $request->input();
		$item = BlogPost::create($data);

		if ($item) {
			$this->dispatch(new BlogPostAfterCreateJob($item));
			return redirect()
				->route('blog.admin.posts.edit', [$item->id])
				->with(['success' => 'Успешно сохранено']);
		} else {
			return back()
				->withErrors(['msg' => 'Ошибка сохранения'])
				->withInput();
		}
	}

	/**
	 * @param $id
	 * @return Application|Factory|View
	 */
	public function edit($id)
	{
		$item = $this->blogPostRepository->getEdit($id);
		if (empty($item)) abort(404);
		$catList = $this->blogCategoryRepository->getForComboBox();
		return view('blog.admin.posts.edit', compact('item', 'catList'));
	}

	public function update(BlogPostUpdateRequest $request, $id)
	{
		$item = $this->blogPostRepository->getEdit($id);
		if (empty($item)) {
			return back()
				->withErrors(['msg' => "Запись id[{$id}] не найдена"])
				->withInput();
		}
		$data = $request->all();

		$res = $item->update($data);

		if ($res) {
			return redirect()
				->route('blog.admin.posts.edit', $item->id)
				->with(['success' => 'Успешно обновлено']);
		} else {
			return back()
				->withErrors(['msg' => "Ошибка сохранения"])
				->withInput();
		}
	}

	/**
	 * @param $id
	 * @return RedirectResponse
	 */
	public function destroy($id)
	{
		/** мягкое удаление "use SoftDeletes" **/
		$res = BlogPost::destroy($id);
		/** Принудительное удаление одного экземпляра модели ...  **/
		//$res = BlogPost::find($id)->forceDelete();

		if ($res) {
			//$this->dispatch(new BlogPostAfterDeleteJob($id));
			BlogPostAfterDeleteJob::dispatch($id)->delay(25);
			return redirect()
				->route('blog.admin.posts.index')
				->with(['success' => "Запись id[{$id}] удалена"]);
		}
		return back()->withErrors(['msg' => 'Ошибка']);
	}
}
