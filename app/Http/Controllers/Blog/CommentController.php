<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCommentRequest;
use App\Models\BlogComment;
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

    /**
     * @param BlogComment $comment
     */
    public function update(BlogComment $comment)
    {
        $comment->update(request(['content']));

    }

    /**
     * @param BlogComment $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(BlogComment $comment)
    {

        $comment->delete();
        if (request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }
}
