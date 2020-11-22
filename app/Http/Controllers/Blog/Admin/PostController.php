<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Requests\BlogPostUpdateRequest;
use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$posts = $this->blogPostRepository->getAllWithPaginate(25);
		return view('blog.admin.posts.index', compact('posts'));
	}

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function create()
	{
		$item = new BlogPost();
		$catList = $this->blogCategoryRepository->getForComboBox();
		return view('blog.admin.posts.edit', compact('item', 'catList'));
	}

	public function store(Request $request)
	{
		dd(__METHOD__, $request->all());
	}

	/**
	 * @param $id
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
			return back()->withErrors(['msg' => "Запись id[{$id}] не найдена"])->withInput();
		}
		$data = $request->all();
		if (empty($data['slug'])) {
			$data['slug'] = Str::slug($data['title']);
		}
		if (empty($item->published_at) && $data['is_published']) {
			$data['published_at'] = Carbon::now();
		}

		$res = $item->update($data);

		if ($res) {
			return redirect()->route('blog.admin.posts.edit',$item->id)->with(['success' => 'Успешно обновлено']);
		} else {
			return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
		}
	}

	public function destroy($id)
	{
		dd(__METHOD__, request()->all(), $id);
	}
}
