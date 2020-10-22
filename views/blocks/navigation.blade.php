<aside x-data="{open:false}" class="w-full h-screen md:w-64 fixed z-10">
    <div class="md:hidden relative pr-4" x-show="!open">
        <button @click="open = true" class="mt-8 float-right">Menu</button>
    </div>

    <nav class="w-full h-full md:w-64 bg-gray-100 p-8 md:mx-0 absolute md:relative md:block z-10"
         :class="{'block' : open, 'hidden': !open}">
        <a class="text-blue-darkest no-underline text-2xl font-bold hidden md:block mb-8"
           href="{{ url($dashboard_url) }}">
            {{config('app.name')}}
        </a>

        <div class="md:hidden text-right">
            <button @click="open = false">Close</button>
        </div>

        <ul class="block list-none menu-items">
            <li>
                <a href="{{ url($dashboard_url) }}">
                    {{trans('aloiacmsgui::interface.dashboard')}}
                </a>
            </li>
            <li>
                <a href="{{ route('pages.index') }}">
                    {{trans('aloiacmsgui::pages.all')}}
                </a>
            </li>
            <li>
                <a href="{{ route('articles.index') }}">
                    {{trans('aloiacmsgui::articles.articles')}}
                </a>
            </li>
            <li>
                <a href="{{ route('media.index') }}">
                    {{trans('aloiacmsgui::images.media')}}
                </a>
            </li>

            <li>
                <a href="{{route('content-blocks.index')}}">
                    {{trans('aloiacmsgui::content_blocks.blocks')}}
                </a>
            </li>

            <li>
                <a href="{{route('files.index')}}">
                    {{trans('aloiacmsgui::files.manage')}}
                </a>
            </li>

            @include('aloiacmsgui::blocks.additional-nav-links')
        </ul>

        <hr class="my-4"/>

        @if(user())
            <form action="{{route('authenticate.logout')}}" method="post">
                {!! csrf_field() !!}
                <button type="submit" class="hover:underline">
                    {{trans('aloiacmsgui::interface.logout')}}
                </button>
            </form>
        @endif

        <a class="text-green-900 bg-green-200 block font-bold px-8 py-4 rounded mt-8 text-center"
           href="{{ url($website_url) }}">
            {{trans('aloiacmsgui::interface.view_website')}}
        </a>

    </nav>
</aside>