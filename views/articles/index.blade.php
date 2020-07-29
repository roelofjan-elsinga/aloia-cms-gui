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

            @include('aloiacmsgui::blocks.models-search-bar', ['route_name' => 'articles.index'])

            @foreach($articles as $article)

                @include('aloiacmsgui::articles.list_item')

            @endforeach

            <div class="mt-8 w-1/2 mx-auto">
                {!! $articles->links() !!}
            </div>

        </section>

        <section class="md:w-1/4">

            @include('aloiacmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection