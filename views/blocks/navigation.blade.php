<aside x-data="{open:false}" class="sticky top-0 self-start w-full md:w-64">
    <div class="md:hidden relative" x-show="!open">
        <button @click="open = true" class="mr-4 float-right bg-white p-4 rounded underline">Menu</button>
    </div>

    <nav class="w-full h-screen md:w-64 bg-gray-100 px-8 py-4 md:mx-0 md:block z-10 hidden"
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
                <a href="{{route('content-blocks.index')}}">
                    {{trans('aloiacmsgui::content_blocks.blocks')}}
                </a>
            </li>

            @include('aloiacmsgui::blocks.additional-nav-links')
        </ul>

        <hr class="my-4"/>

        <a class="green-button block px-8 py-4 rounded mt-8 text-center"
           href="{{ url($website_url) }}">
            {{trans('aloiacmsgui::interface.view_website')}}
        </a>

    </nav>
</aside>