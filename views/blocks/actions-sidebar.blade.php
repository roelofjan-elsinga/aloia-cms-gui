<div class="bg-gray-200 p-4 rounded-lg mb-4 md:mb-0">
    <h3 class="mb-4 block">{{trans('aloiacmsgui::interface.what_to_do')}}</h3>

    <a href="{{route('pages.index')}}"
       class="text-blue-800 mb-2 block">
        {{trans('aloiacmsgui::pages.manage')}}
    </a>

    <a href="{{route('articles.index')}}"
       class="text-blue-800 mb-2 block">
        {{trans('aloiacmsgui::articles.manage')}}
    </a>

    <a href="{{route('media.index')}}"
       class="text-blue-800 mb-2 block">
        {{trans('aloiacmsgui::images.manage')}}
    </a>

    <a href="{{route('content-blocks.index')}}"
       class="text-blue-800 mb-2 block">
        {{trans('aloiacmsgui::content_blocks.manage')}}
    </a>

    <a href="{{route('files.index')}}"
       class="text-blue-800 mb-2 block">
        {{trans('aloiacmsgui::files.manage')}}
    </a>
</div>