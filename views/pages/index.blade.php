@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            <h1 class="mb-4">
                {{_translate('EDIT_YOUR_PAGES')}}
            </h1>

            @if(session()->has('updated_article') || session()->has('create_article'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('PAGE_SAVED')}}
                </div>
            @endif

            @foreach($pages as $page)

                <div class="flex mb-2 text-blue-900 no-underline">
                    <div class="w-32">
                        @if(!empty($page->image()))
                            <img src="{{asset($page->image())}}" alt="{{$page->title()}}" style="max-height: 75px;"/>
                        @endif
                    </div>
                    <div class="px-4 py-2">
                        <h4 class="flex-1 font-bold">
                            <a href="{{route('pages.edit', $page->slug())}}">{{$page->title()}}</a>
                            <small class="inline-block text-blue-600">
                                <a href="/{{$page->slug(true)}}" target="_blank" class="underline">({{_translate("VIEW_PAGE")}})</a>
                            </small>
                        </h4>

                        @if($page->isPublished())
                            <p class="status green">{{_translate('PUBLISHED')}}</p>
                        @endif

                        @if(!$page->isPublished())
                            <p class="status">{{_translate('DRAFT')}}</p>
                        @endif

                        @if($page->isHomepage())
                            <p class="status orange">{{_translate('HOMEPAGE')}}</p>
                        @endif

                        @if($page->isInMenu())
                            <p class="status blue">{{_translate('IS_IN_MENU')}}</p>
                        @endif
                    </div>
                </div>

            @endforeach

        </section>

        <section class="md:w-1/4">

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection