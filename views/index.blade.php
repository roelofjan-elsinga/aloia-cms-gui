@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8">Welcome {{user()->username()}}!</h1>

    <main class="flex">

        <section class="flex-1 mr-4">



        </section>

        <section class="w-1/4">

            <h3 class="mb-4 block">What do you want to do?</h3>

            <a href="{{route('pages.create')}}"
               class="text-blue-800 mb-2 block">
                Create a new page
            </a>

            <a href="{{route('articles.create')}}"
               class="text-blue-800 mb-2 block">
                Create a new article
            </a>

            <a href="{{route('media.index')}}"
               class="text-blue-800 mb-2 block">
                Manage images
            </a>

        </section>

    </main>

@endsection