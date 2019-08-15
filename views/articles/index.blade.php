@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            <h1 class="mb-4">
                {{_translate('MANAGE_ARTICLES')}}
            </h1>

            <a href="{{route('articles.create')}}"
               class="text-blue-800 mb-2 block underline">
                {{_translate('CREATE_NEW_ARTICLE')}}
            </a>

            @if(session()->has('updated_article') || session()->has('create_article'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('ARTICLE_UPDATED_SUCCESS')}}
                </div>
            @endif

            @foreach($articles as $article)

                <div class="flex mb-4 text-blue-900 no-underline">
                    <div class="w-1/4 md:w-32">
                        @if(!empty($article['image']))
                            <img src="{{asset($article['image'])}}" alt="{{$article['title']}}" style="max-height: 75px;"/>
                        @endif
                    </div>
                    <div class="w-3/4 px-4">
                        <h4 class="flex-1 font-bold">
                            <a href="{{route('articles.edit', $article['slug'])}}">{{$article['title']}}</a>
                            <small class="inline-block text-blue-600">
                                <a href="/articles/{{$article['slug']}}" target="_blank" class="underline">({{_translate("VIEW_PAGE")}})</a>
                            </small>
                        </h4>

                        @if($article['isPublished'])
                            <p class="status green">{{_translate('PUBLISHED')}}</p>
                        @endif

                        @if($article['isScheduled'])
                            <p class="status orange">{{_translate('SCHEDULED')}}</p>
                        @endif

                        @if(!$article['isPublished'] && !$article['isScheduled'])
                            <p class="status">{{_translate('DRAFT')}}</p>
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