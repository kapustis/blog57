@forelse($posts as $post)
    <li class="content_item">
        <article class="post_preview">
            <header class="post_meta">
                <a href="#" class="user_info" title="avtor">
                    <span class="user_nick">{{$post->creator->name}}</span>
                </a>
                <span class="post_time">{{$post->created_at}}</span>
            </header>
            <h2 class="post_title">
                <a href="#"> {{$post->title}}</a>
            </h2>
            <div class="post_body">
                <div class="post_text">
                    <p><img src="/images/posts/0{{rand(1,6)}}.jpg" alt="{{$post->title}}"></p>
                    <p> {!! stristr($post->body, '</div>' ,true) !!}</p>
                </div>
            </div>
            <a href="#" class="button" style="left: 0">
                Читать
            </a>
        </article>
    </li>
@empty
    <p>Нет соответствующих результатов в это время</p>
    <p>There are no relevant results at this time.</p>
@endforelse
