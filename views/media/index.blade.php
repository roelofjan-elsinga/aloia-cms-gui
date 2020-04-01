@extends('aloiacmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            @if(Session::has('upload_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::images.uploaded')}}
                </div>
            @endif

            @if(Session::has('delete_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::images.deleted')}}
                </div>
            @endif

            <h1 class="mb-4 text-xl font-semibold">{{trans('aloiacmsgui::images.manage')}}</h1>

            <p class="mb-2">
                {{trans('aloiacmsgui::images.include_in_post')}}
            </p>

            <a href="{{route('media.create')}}" class="text-blue-800 mb-2 block underline">{{trans('aloiacmsgui::images.upload_new')}}</a>

            @foreach($images as $image)

                <div class="flex mb-4 flex-col md:flex-row">

                    <img src="{{asset($image->getPathname())}}" class="w-full md:w-1/6 mr-2">

                    <div class="w-5/6">
                        <h4>Markdown</h4>
                        <p class="text-sm bg-gray-400 block p-2">!["{{\AloiaCms\Media::filenameToTitle($image->getFilename())}}"](/{{$image->getPathname()}})</p>

                        <h4 class="mt-2">{{trans('aloiacmsgui::images.as_url')}}</h4>

                        <p class="text-sm">{{asset($image->getPathname())}}</p>
                    </div>

                </div>

            @endforeach

        </section>

        <section class="md:w-1/4">

            @include('aloiacmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection
