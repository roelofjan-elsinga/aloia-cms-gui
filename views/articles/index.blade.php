@extends('aloiacmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            <h1 class="mb-4">
                {{trans('aloiacmsgui::articles.manage')}}
            </h1>

            <a href="{{route('articles.create')}}"
               class="text-blue-800 mb-2 block underline">
                {{trans('aloiacmsgui::articles.create_new')}}
            </a>

            @if(session()->has('updated_article') || session()->has('created_article') || session()->has('deleted_article'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::articles.updated_success')}}
                </div>
            @endif

            @foreach($articles as $article)

                <div class="flex mb-4 text-blue-900 no-underline">
                    <div class="w-1/4 md:w-32">
                        @if(!empty($article['image']))
                            <img src="{{asset($article['image'])}}" alt="{{$article['title']}}" style="max-height: 75px;"/>
                        @else
                            <img src="https://via.placeholder.com/115x75?text=Featured%20image" alt="Placeholder featured image" style="max-height: 75px;"/>
                        @endif
                    </div>
                    <div class="w-3/4 px-4">
                        <h4 class="flex-1 font-bold">
                            <a href="{{route('articles.edit', $article['slug'])}}">{{$article['title']}}</a>
                            <small class="inline-block text-blue-600">
                                <a href="/articles/{{$article['slug']}}" target="_blank" class="underline">({{trans("aloiacmsgui::pages.view")}})</a>
                            </small>
                        </h4>

                        <div>
                            {{trans('aloiacmsgui::articles.post_date')}}: {{$article['postDate']->format('F jS, Y')}}
                        </div>

                        @if($article['isPublished'])
                            <p class="status green">{{trans('aloiacmsgui::articles.published')}}</p>
                        @endif

                        @if($article['isScheduled'])
                            <p class="status orange">{{trans('aloiacmsgui::articles.scheduled')}}</p>
                        @endif

                        @if(!$article['isPublished'] && !$article['isScheduled'])
                            <p class="status">{{trans('aloiacmsgui::articles.draft')}}</p>
                        @endif
                    </div>
                </div>

            @endforeach

            <div class="mt-8">
                {!! $articles->links() !!}
            </div>

        </section>

        <section class="md:w-1/4">

            @include('aloiacmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection