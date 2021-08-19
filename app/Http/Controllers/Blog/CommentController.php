<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCommentRequest;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index(BlogPost $post)
    {
        return $post->comments()->paginate(5);
    }

    /**
     * @param BlogPost $post
     * @param BlogCommentRequest $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(BlogPost $post, BlogCommentRequest $request): \Illuminate\Database\Eloquent\Model
    {

        return $post->addComment([
            'content' =>request('content'),
            'user_id' => auth()->id()
        ])->load('owner');
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
