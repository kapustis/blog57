<h3 id="comment-list">Все комментарии</h3>

    @if ($comments->count())
        @foreach ($comments as $comment)

            <div class="card mb-3" id="{{ $comment->id }}">
                <div class="card-header p-2">
                    {{ $comment->owner->name }}
                </div>
                <div class="card-body p-2">
                    {{ $comment->content }}
                </div>
                <div class="card-footer p-2">
                    {{ $comment->created_at->diffForHumans()  }}
                </div>
            </div>
        @endforeach

    @else
        <p>К этому посту еще нет комментариев</p>
    @endif
@if(Auth::check())
    <textarea class="form-control"></textarea>
@else
    <p class="text-center">Пожалуйста <a href="{{route('login')}}">авторизируйтесь</a> , чтобы принять участие в обсуждении.</p>
@endif
