<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\StoreBlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

/**
 * Управление категориями блога
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{

	/** @var  BlogCategoryRepository */
	private $blogCategoryRepository;

	public function __construct()
	{
		parent::__construct();
		$this->blogCategoryRepository = app(BlogCategoryRepository::class);
	}

	/**
	 * @return Factory|Application|Response|View
	 */
	public function index()
	{
		$categories = $this->blogCategoryRepository->getAllWithPaginate(10);
		return view('blog.admin.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return Factory|Application|Response|View
	 */
	public function create()
	{
		$item = BlogCategory::make();
		$catList = $this->blogCategoryRepository->getForComboBox();
		return view('blog.admin.categories.edit', compact('item', 'catList'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreBlogCategory $request
	 * @return RedirectResponse
	 */
	public function store(StoreBlogCategory $request)
	{
		$data = $request->input();

		$item = BlogCategory::create($data);

		if ($item) {
			return redirect()
				->route('blog.admin.categories.edit', [$item->id])
				->with(['success' => 'Успешно сохранено']);
		} else {
			return back()
				->withErrors(['msg' => 'Ощибка сохранения'])
				->withInput();
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return Factory|Application|View|void
	 */
	public function edit($id)
	{
		$item = $this->blogCategoryRepository->getEdit($id);

		if (empty($item)) abort(404);

		$catList = $this->blogCategoryRepository->getForComboBox();
		return view('blog.admin.categories.edit', compact('item', 'catList'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param BlogCategoryUpdateRequest $request
	 * @param  $id
	 * @return RedirectResponse
	 */
	public function update(BlogCategoryUpdateRequest $request, $id)
	{
		$item = $this->blogCategoryRepository->getEdit($id);
		if (empty($item)) {
			return back()
				->withErrors(['msg' => "Запись ненайдена id=[$id]"])
				->withInput();
		}
		$data = $request->all();
		$res = $item->update($data);
		if ($res) {
			return redirect()
				->route('blog.admin.categories.edit', $item->id)
				->with(['success' => 'Успешно сщхранено']);
		} else {
			return back()
				->withErrors(['msg' => "Ошибка сохранения id=[$id]"])
				->withInput();
		}
	}

}
