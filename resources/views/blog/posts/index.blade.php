@extends('layouts.app')

@section('content')
    <section>
        <form method="get" action="{{route('blog.posts.index')}}">
            @csrf

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

            <div class="list-group">
                <div class="post_list">
                    <ul class="content_list">
                        @include('blog.posts._lists')
                    </ul>
                </div>
            </div>

            <div>
                @if($posts->total() > $posts->count())
                    {{$posts->appends(compact('items'))->links("vendor.pagination.default")}}
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

        </form>
    </section>

    {{--todo   so not very good, but I don’t know yet how differently--}}
    <script>
      document.getElementById('pagination').onchange = function () {
        window.location = "{!! $posts->url(1) !!}&items=" + this.value;
      };
    </script>

@endsection
