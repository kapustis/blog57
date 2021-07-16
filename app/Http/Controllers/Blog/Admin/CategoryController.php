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
 * manage blog categories
 * Управление категориями блога
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{

    /** @var  BlogCategoryRepository */
    private $blogCategoryRepository;

    public function __construct()//(BlogCategoryRepository $blogCategoryRepository)
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
//        $this->blogCategoryRepository = $blogCategoryRepository;

        $this->middleware('perm:manage-categories')->only('index');
        $this->middleware('perm:create-category')->only(['create', 'store']);
        $this->middleware('perm:edit-category')->only(['edit', 'update']);
        $this->middleware('perm:delete-category')->only('destroy');
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
        $categoryList = $this->blogCategoryRepository->getCategoryList();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));

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
            return redirect()->route('blog.admin.categories.edit', [$item->id])->with(['success' => 'Успешно сохранено']);
        }

        return back()->withErrors(['msg' => 'Ощибка сохранения'])->withInput();

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
        if (empty($item)) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getCategoryList();

        return view('blog.admin.categories.edit', compact('item', 'categoryList'));

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
            return back()->withErrors(['msg' => "Запись не найдена id=[$id]"])->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);
        if ($result) {
            return redirect()->route('blog.admin.categories.edit', $item->id)->with(['success' => 'Успешно сохранено']);
        }
        return back()->withErrors(['msg' => "Ошибка сохранения id=[$id]"])->withInput();

    }

}
