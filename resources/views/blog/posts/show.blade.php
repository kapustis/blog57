@php /** @var \App\Models\BlogPost $post **/ @endphp

@extends('layouts.app',['title' => $post->title])

@section('content')
    <blog-item :post="{{$post}}" inline-template>
        <div>
            <div class="card mb-4">
                @if ($post->image)
                    <img src="{{ asset('storage/post/image/'.$post->image) }}" alt="" class="card-img-top"/>
                @else
                    <img src="/images/posts/0{{rand(1,6)}}.jpg" alt="{{ $post->title }}" class="card-img-top">
                @endif
                <div class="card-img-overlay">
                    <h1 class="card-title" style="color: tomato">{{ $post->title }}</h1>
                </div>
                <div class="card-body">
                    {{-- <h1 class="card-title">{{ $post->title }}</h1>--}}
                     <div class="mt-4" v-html="post.content_html"></div>
                     {{--div class="mt-4">{!! $post->content_html !!}</div>--}}
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
            <Comments></Comments>
        </div>
    </blog-item>
    {{--    @include('blog.posts.comments', ['comments' => $post->comments])--}}
@endsection

