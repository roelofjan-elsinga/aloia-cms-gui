<nav class="menu block w-full" id="home">
    <div class="flex h-16 md:h-32">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="block flex-1 items-center text-blue-darkest no-underline text-2xl font-bold hidden md:flex"
           href="{{ url($dashboard_url) }}">
            {{config('app.name')}}
        </a>

        <ul class="block flex-1 flex items-center justify-end">
            <li class="inline-block mx-2">
                <a class="link text-xs md:text-base" href="{{ route('pages.index') }}">
                    {{_translate('PAGES')}}
                </a>
            </li>
            <li class="inline-block mx-2">
                <a class="link text-xs md:text-base" href="{{ route('articles.index') }}">
                    {{_translate('ARTICLES')}}
                </a>
            </li>
            <li class="inline-block mx-2">
                <a class="link text-xs md:text-base" href="{{ route('media.index') }}">
                    {{_translate('MEDIA')}}
                </a>
            </li>
            <li class="inline-block mx-2 p-2 bg-green-200 rounded-lg">
                <a class="link text-xs md:text-base" href="{{ url($website_url) }}">
                    {{_translate('VIEW_WEBSITE')}}
                </a>
            </li>

            @if(user())
            <li class="inline-block mx-2 p-2 bg-red-200 rounded-lg">
                <form action="{{route('authenticate.logout')}}" method="post">
                    {!! csrf_field() !!}
                    <button type="submit" class="link text-xs md:text-base">
                        {{_translate('LOGOUT')}}
                    </button>
                </form>
            </li>
            @endif
        </ul>
    </div><!-- /.container-fluid -->
</nav>
