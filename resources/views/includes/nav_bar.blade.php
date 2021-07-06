<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

        </ul>
        <form method="get" action="{{route('blog.posts.search')}}" class="form-inline my-2 my-lg-0">
{{--            @csrf--}}
            <input class="form-control mr-sm-2" type="search" name="search"
                   @if(isset($search)) value="{{$search}}" @endif
                   placeholder="Search" aria-label="Search"
            >
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
