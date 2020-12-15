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
    /**
     * Display a listing of the resource.
     * @return Factory|Application|Response|View
     */
    public function index()
    {
        $posts = BlogPost::all();

        return view('blog.posts.index', compact('posts'));
    }
}
