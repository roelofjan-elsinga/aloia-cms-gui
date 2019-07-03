@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex">

        <section>

            <h3 class="mb-4">
                Edit your articles
            </h3>

            @if(session()->has('updated_article') || session()->has('create_article'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>Great!</strong> The article was saved successfully!
                </div>
            @endif

            @foreach($articles as $article)

                <a href="{{route('articles.edit', $article['slug'])}}" class="flex mb-2 text-blue-900 no-underline">
                    <div class="w-32">
                        @if(!empty($article['image']))
                            <img src="{{asset($article['image'])}}" alt="{{$article['title']}}" style="max-height: 75px;"/>
                        @endif
                    </div>
                    <div class="px-4 py-2">
                        <h4 class="flex-1 font-bold">{{$article['title']}}</h4>

                        @if($article['isPublished'])
                            <p class="status green">Published</p>
                        @endif

                        @if($article['isScheduled'])
                            <p class="status orange">Scheduled for publishing</p>
                        @endif

                        @if(!$article['isPublished'] && !$article['isScheduled'])
                            <p class="status">Draft</p>
                        @endif
                    </div>
                </a>

            @endforeach

        </section>

    </main>

@endsection