@extends('layouts.app')

@section('content')

    @include('blog.posts._lists')

    {{ $posts->links('vendor.pagination.default') }}
@endsection
