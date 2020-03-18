@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            @if(Session::has('upload_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('IMAGE_UPLOADED')}}
                </div>
            @endif

            @if(Session::has('delete_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('IMAGE_DELETED')}}
                </div>
            @endif

            <h1 class="mb-4 text-xl font-semibold">{{_translate('MANAGE_IMAGES')}}</h1>

            <p class="mb-2">
                {{_translate('HOW_TO_INCLUDE_IN_POST')}}
            </p>

            <a href="{{route('media.create')}}" class="text-blue-800 mb-2 block underline">{{_translate('UPLOAD_AN_IMAGE')}}</a>

            @foreach($images as $image)

                <div class="flex mb-4 flex-col md:flex-row">

                    <img src="{{asset($image->getPathname())}}" class="w-full md:w-1/6 mr-2">

                    <div class="w-5/6">
                        <h4>Markdown</h4>
                        <p class="text-sm bg-gray-400 block p-2">!["{{\AloiaCms\Media::filenameToTitle($image->getFilename())}}"](/{{$image->getPathname()}})</p>

                        <h4 class="mt-2">{{_translate('AS_URL')}}</h4>

                        <p class="text-sm">{{asset($image->getPathname())}}</p>
                    </div>

                </div>

            @endforeach

        </section>

        <section class="md:w-1/4">

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection
