<nav class="menu block w-full" id="home">
    <div class="flex h-16 md:h-32">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="block flex-1 items-center text-blue-darkest no-underline text-2xl font-bold hidden md:flex"
           href="{{ url($dashboard_url) }}">
            {{config('app.name')}}
        </a>

        <ul class="block flex-1 flex items-center justify-end space-x-4">
            <li>
                <a class="link text-xs md:text-base" href="{{ route('pages.index') }}">
                    {{trans('aloiacmsgui::pages.all')}}
                </a>
            </li>
            <li>
                <a class="link text-xs md:text-base" href="{{ route('articles.index') }}">
                    {{trans('aloiacmsgui::articles.articles')}}
                </a>
            </li>
            <li>
                <a class="link text-xs md:text-base" href="{{ route('media.index') }}">
                    {{trans('aloiacmsgui::images.media')}}
                </a>
            </li>
            <li>
                <a class="green-button"
                   href="{{ url($website_url) }}">
                    {{trans('aloiacmsgui::interface.view_website')}}
                </a>
            </li>

            @if(user())
            <li>
                <form action="{{route('authenticate.logout')}}" method="post">
                    {!! csrf_field() !!}
                    <button type="submit" class="red-button">
                        {{trans('aloiacmsgui::interface.logout')}}
                    </button>
                </form>
            </li>
            @endif
        </ul>
    </div><!-- /.container-fluid -->
</nav>
