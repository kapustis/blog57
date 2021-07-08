<ul class="drop-menu">
    @foreach (array_keys(config('locale.languages')) as $lang)
        @if ($lang != app()->getLocale())
            <li>
                <a href="{{ '/lang/'.$lang }}"> {{ __('menus.language-picker.langs.'.$lang) }}</a>
            </li>
        @endif
    @endforeach
</ul>
