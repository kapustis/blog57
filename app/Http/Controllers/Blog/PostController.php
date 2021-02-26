<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\BlogPost;

use Illuminate\Http\Request;

class PostController extends BaseController
{
    const POST_PAGINATION = 10; // transfer to .env

    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $posts = BlogPost::paginate(self::POST_PAGINATION);

        return view('blog.posts.index', compact('posts'));
    }

    /**
     * List the search result for a resource.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $results = BlogPost::where('title', 'LIKE', "%{$request->search}%")->paginate(self::POST_PAGINATION);

        return view('blog.posts.index',['posts'=>$results, 'search'=>$request->search]);

    }
}
