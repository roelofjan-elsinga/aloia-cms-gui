<div class="bg-gray-200 p-4 rounded-lg mb-4 md:mb-0">
    <h3 class="mb-4 block">{{_translate('WHAT_DO_YOU_WANT')}}</h3>

    <a href="{{route('pages.create')}}"
       class="text-blue-800 mb-2 block">
        {{_translate('CREATE_NEW_PAGE')}}
    </a>

    <a href="{{route('articles.create')}}"
       class="text-blue-800 mb-2 block">
        {{_translate('CREATE_NEW_ARTICLE')}}
    </a>

    <a href="{{route('media.index')}}"
       class="text-blue-800 mb-2 block">
        {{_translate('MANAGE_IMAGES')}}
    </a>
    <a href="{{route('content-blocks.index')}}"
       class="text-blue-800 mb-2 block">
        {{_translate('MANAGE_CONTENT_BLOCKS')}}
    </a>
    <a href="{{route('taxonomy.index')}}"
       class="text-blue-800 mb-2 block">
        {{_translate('MANAGE_TAXONOMY')}}
    </a>
</div>