<aside x-data="{open:false}" class="w-screen md:w-64">
    <div class="md:hidden text-right" x-show="!open">
        <button @click="open = true" class="mt-8">Menu</button>
    </div>

    <nav class="w-screen h-screen md:w-64 bg-gray-100 p-8 -mx-4 md:mx-0 absolute md:relative md:block"
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

        <a class="text-green-900 bg-green-200 block font-bold px-8 py-4 rounded mt-8"
           href="{{ url($website_url) }}">
            {{trans('aloiacmsgui::interface.view_website')}}
        </a>

    </nav>
</aside>