@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex">

        <section class="flex-1 mr-4">

            <h3 class="mb-4">
                Edit your pages
            </h3>

            @if(session()->has('updated_article') || session()->has('create_article'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>Great!</strong> The page was saved successfully!
                </div>
            @endif

            @foreach($articles as $article)

                <a href="{{route('pages.edit', $article['slug'])}}" class="flex mb-2 text-blue-900 no-underline">
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

                        @if(!$article['isPublished'])
                            <p class="status">Not published</p>
                        @endif

                        @if($article['isHomepage'])
                            <p class="status orange">Homepage</p>
                        @endif
                    </div>
                </a>

            @endforeach

        </section>

        <section class="w-1/4">

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection