<header>
    <nav class="hed_nav">
        <ul class="nav_links">
            <li><a href="/" class="active">{{__('navs.general.home')}}</a></li>
            <li class="land"><a href="{{url('/blog')}}">{{__('navs.general.blog')}}</a></li>
            @if (config('locale.status') && count(config('locale.languages')) > 1)
                <li >
                    <a href="#" type="button" class="lang">
                        <span>{{ __('menus.language-picker.language') }} ({{ strtoupper(app()->getLocale()) }})</span>
                    </a>
                    @include('includes.partials.lang')
                </li>
            @endif
            <li>
                <ul>
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">{{__('navs.frontend.login')}}</a></li>
                        <li><a href="{{ route('register') }}">{{__('navs.frontend.register')}}</a></li>
                    @else
                        <user-notifications></user-notifications>
                        <li>
                            <ul>
                                <li>
                                    <a href="{{route('profile',Auth::user())}}"> {{__('navs.frontend.user.profile')}}</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >{{__('navs.frontend.user.logout')}}
                                    </a>
                                    <form id="logout-form"
                                          action="{{ route('logout') }}"
                                          method="POST"
                                          style="display: none;"
                                    >{{ csrf_field() }}</form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </nav>
</header>

