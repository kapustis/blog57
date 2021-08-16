<?php

namespace App\Http\Controllers\Blog;

use App\Repositories\BlogPostRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\BlogPost;

use Illuminate\Http\Request;

class PostController extends BaseController
{
    const POST_PAGINATION = 10; // transfer to .env

    /** @var BlogPostRepository * */
    private $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepository)
    {
        parent::__construct();
        $this->blogPostRepository = $blogPostRepository;
    }


    /**
     * Display a listing of the resource and list the search result for a resource.
     * @param Request $request
     * @return Factory|Application|Response|View
     */
    public function index(Request $request)
    {
        $items = $request->items ?? self::POST_PAGINATION;

        $posts = BlogPost::where('title', 'LIKE', "%{$request->search}%")->paginate($items)->withQueryString();

        return view('blog.posts.index')->
        withPosts($posts)->
        withItems($items)->
        withSearch($request->search);
    }
    /**
     * Post search results
     * Результаты поиска по постам, авторам и тегам
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $search = $request->input('search');

        $posts = BlogPost::where('title', 'LIKE', "%{$request->search}%")->paginate(1)->withQueryString();

        return view('blog.posts.search', compact('posts', 'search'));
    }

    /**
     * Display blog post.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $post = $this->blogPostRepository->getItem($id);

        $comments = $post->comments()->orderBy('created_at')->paginate(5);

        if (empty($post)) {
            abort(404);
        }

        return view('blog.posts.show', compact('post', 'comments'));
    }
}
