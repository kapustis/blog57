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

/**
 * Class PostController
 * @package App\Http\Controllers\Blog\Admin
 */
class PostController extends BaseController
{

    /** @var BlogPostRepository * */
    private $blogPostRepository;
    /** @var  BlogCategoryRepository * */
    private $blogCategoryRepository;

    /** postController constructor *
     * @param BlogPostRepository $blogPostRepository
     * @param BlogCategoryRepository $blogCategoryRepository
     */
    public function __construct(BlogPostRepository $blogPostRepository, BlogCategoryRepository $blogCategoryRepository)
    {
        parent::__construct();
        $this->blogPostRepository = $blogPostRepository;
        $this->blogCategoryRepository = $blogCategoryRepository;

        $this->middleware('perm:manage-posts')->only(['index']);
        $this->middleware('perm:create-post')->only(['create', 'store']);
        $this->middleware('perm:edit-post')->only(['edit', 'update']);
        $this->middleware('perm:delete-post')->only('destroy');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $posts = $this->blogPostRepository->getAllWithPaginate(10);

        return view('blog.admin.posts.index', compact('posts'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $item = BlogPost::make();
        $categoryList = $this->blogCategoryRepository->getCategoryList();
        return view('blog.admin.posts.edit', compact('item', 'categoryList'));
    }

    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();
        $item = BlogPost::create($data);

        if ($item) {
            $this->dispatch(new BlogPostAfterCreateJob($item));

            return redirect()->route('blog.admin.posts.edit', [$item->id])->with(['success' => 'Успешно сохранено']);
        }

        return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getCategoryList();

        return view('blog.admin.posts.edit', compact('item', 'categoryList'));

    }

    /**
     * @param BlogPostUpdateRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(BlogPostUpdateRequest $request, $id): RedirectResponse
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->update($data);

        if ($result) {
            return redirect()->route('blog.admin.posts.edit', $item->id)->with(['success' => 'Успешно обновлено']);
        }

        return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();

    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        /** мягкое удаление "use SoftDeletes" **/
        $result = BlogPost::destroy($id);
        /** Принудительное удаление одного экземпляра модели ...  **/
        //$res = BlogPost::find($id)->forceDelete();

        if ($result) {
            //$this->dispatch(new BlogPostAfterDeleteJob($id));
            BlogPostAfterDeleteJob::dispatch($id)->delay(25);

            return redirect()->route('blog.admin.posts.index')->with(['success' => "Запись id[{$id}] удалена"]);
        }

        return back()->withErrors(['msg' => 'Ошибка']);
    }

}
