@extends('layouts.app',['title' => 'Поиск по блогу'])

@section('content')
    <h1 class="mb-3">Поиск по блогу</h1>
    <p>Поисковый запрос: {{ $search ?? 'пусто' }}</p>

    @if($posts->count())
        @include('blog.posts._lists')

        <div class="d-flex justify-content-center mb-5">
            {{ $posts->links('vendor.pagination.default') }}
        </div>
    @else
        <p>По вашему запросу ничего не найдено</p>
    @endif
@endsection
