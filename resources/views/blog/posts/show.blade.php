@extends('layouts.app',['title' => $post->title])

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h1>{{ $post->title }}</h1>
        </div>
        <div class="card-body">
            @if ($post->image)
                <img src="{{ asset('storage/post/image/'.$post->image) }}" alt="" class="img-fluid"/>
            @else
                <img src="/images/posts/0{{rand(1,6)}}.jpg" alt="{{ $post->title }}" class="img-fluid">
            @endif
            <div class="mt-4">{!! $post->content_html !!}</div>
        </div>
        <div class="card-footer">
            Автор:
            <a href="#">
                {{ $post->creator->name }}
            </a>
            <br>
            Дата: {{ $post->created_at }}
        </div>
    </div>
    @include('blog.posts.comments', ['comments' => $comments])
@endsection
