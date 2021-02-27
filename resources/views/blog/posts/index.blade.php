@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="search w-60">
                <h1 class="text-center mb-6">Search</h1>
                <form method="get" action="{{route('blog.index')}}">
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
                                        {{$posts->appends(compact('items'))->links("vendor.pagination.bootstrap-4")}}
                                    @endif
                                    @if(isset($items))
                                        <form>
                                            <select id="pagination" class="custom-select col-md-1">
                                                <option value="5" @if($items == 5) selected @endif >5</option>
                                                <option value="10" @if($items == 10) selected @endif >10</option>
                                                <option value="25" @if($items == 25) selected @endif >25</option>
                                            </select>
                                        </form>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--todo   so not very good, but I don’t know yet how differently--}}
    <script>
      document.getElementById('pagination').onchange = function () {
        window.location = "{!! $posts->url(1) !!}&items=" + this.value;
      };
    </script>

@endsection
