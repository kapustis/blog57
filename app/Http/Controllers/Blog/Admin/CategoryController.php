<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\StoreBlogCategory;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;

use Illuminate\Http\RedirectResponse;

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
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
	 */
	public function index()
	{
//		$categories = BlogCategory::paginate(15);
		$categories =  $this->blogCategoryRepository->getAllWithPaginate(3);
		return view('blog.admin.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
	 */
	public function create()
	{
		$item = new BlogCategory();
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
//				dd(__METHOD__, $request->all());
		$data = $request->input();
		if (empty($data['slug'])) {
			$data['slug'] = str_slug($data['title']);
		}
		$item = (new BlogCategory())->create($data);
//				$item = new BlogCategory($data);
//				$item->save();

		if ($item) {
			return redirect()->route('blog.categories.edit', [$item->id])
				->with(['success' => 'Успешно сохоанено']);
		} else {
			return back()->withErrors(['msg' => 'Ощибка сохранения'])->withInput();
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @param BlogCategoryRepository $categoryRepository
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View|void
	 */
	public function edit($id)
	{
		$item = $this->blogCategoryRepository->getEdit($id);
		if (empty($item)) dd('no edit item category');
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
			return back()->withErrors(['msg' => "Запись ненайдена id=[$id]"])->withInput();
		}
		$data = $request->all();
		$res = $item->update($data);
		if ($res) {
			return redirect()->route('blog.admin.categories.edit', $item->id)->with(['success' => 'Успешно сщхранено']);
		} else {
			return back()->withErrors(['msg' => "Ошибка сохранения id=[$id]"])->withInput();
		}
	}

}
