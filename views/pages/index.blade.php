@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-4">
        {{trans('aloiacmsgui::pages.manage')}}
    </h1>

    <a href="{{route('pages.create')}}"
       class="text-blue-800 mb-2 block underline">
        {{trans('aloiacmsgui::pages.create_new')}}
    </a>

    @if(session()->has('updated_page') || session()->has('created_page') || session()->has('deleted_page'))
        <div class="bg-green-600 text-white p-4 rounded mb-4">
            <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::pages.saved')}}
        </div>
    @endif

    @include('aloiacmsgui::blocks.models-search-bar', ['route_name' => 'pages.index'])

    @foreach($pages as $page)

        <div class="flex mb-2 text-theme-darkest no-underline">
            <div class="w-32">
                @if(!empty($page->image()))
                    <img src="{{asset($page->image())}}" alt="{{$page->title()}}" style="max-height: 75px;"/>
                @endif
            </div>
            <div class="px-4 py-2">
                <h4 class="flex-1 font-bold">
                    <a href="{{route('pages.edit', $page->filename())}}">{{$page->title()}}</a>
                    <small class="inline-block text-blue-600">
                        <a href="/{{$page->url()}}" target="_blank" class="underline">({{trans("aloiacmsgui::pages.view")}})</a>
                    </small>
                </h4>

                @if($page->isPublished())
                    <p class="status green">{{trans('aloiacmsgui::articles.published')}}</p>
                @endif

                @if(!$page->isPublished())
                    <p class="status">{{trans('aloiacmsgui::articles.draft')}}</p>
                @endif

                @if($page->isHomepage())
                    <p class="status orange">{{trans('aloiacmsgui::pages.homepage')}}</p>
                @endif

                @if($page->isInMenu())
                    <p class="status blue">{{trans('aloiacmsgui::interface.in_menu')}}</p>
                @endif
            </div>
        </div>

    @endforeach

    <div class="mt-8">
        {!! $pages->links() !!}
    </div>

@endsection