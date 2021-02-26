@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="search w-60">
                <h1 class="text-center mb-6">Search</h1>
                <form method="get" action="{{route('posts.search')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group">
                                <input type="search" name="search"
                                       class="form-control search"
                                       placeholder="What are you looking for ... "
                                       @if(isset($search)) value="{{$search}}" @endif
                                >
                                <span class="input-group-prepend">
                                     <button type="submit" class="btn btn-primary">Click</button>
                                </span>

                            </div>


                            <div>
                                <table>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post ->id}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>{{$post->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="row justify-content-center pt-2">
                                    @if($posts->total() > $posts->count())
                                        {{$posts->withQueryString()->links("vendor.pagination.bootstrap-4")}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <div id="post" class="mt-5">

                </div>
            </div>
        </div>
    </div>




@endsection
