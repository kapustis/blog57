@extends('layouts.app')

@section('content')

    @include('blog.posts._lists')

    <div class="d-flex justify-content-center mb-5">
        {{ $posts->links('vendor.pagination.default') }}
    </div>

@endsection
