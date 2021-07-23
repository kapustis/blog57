@forelse($posts as $post)
    <div class="card mb-4">
        <div class="card-header">
            <h2>{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            @if ($post->image)
                <img src="{{ asset('storage/post/image/'.$post->image) }}" alt="{{ $post->title }}" class="img-fluid"/>
            @else
                <img src="/images/posts/0{{rand(1,6)}}.jpg" alt="{{ $post->title }}" width="800" height="1200" class="img-fluid">
            @endif
        </div>
        <div class="card-footer">
            <div class="clearfix">
            <span class="float-left">
                Автор:
                <a href="#"> {{ $post->creator->name }} </a>
                <br>
                Дата: {{ $post->created_at }}
            </span>
                <span class="float-right">
                <a href="{{ route('blog.posts.show', $post)}}" class="btn btn-dark">Читать дальше</a>
            </span>
            </div>
        </div>
    </div>
@empty
    <p>Нет соответствующих результатов в это время</p>
    <p>There are no relevant results at this time.</p>
@endforelse
