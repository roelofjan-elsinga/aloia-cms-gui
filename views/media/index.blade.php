@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex">

        <section class="flex-1 mr-4">

            @if(Session::has('upload_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>Great!</strong> The image was uploaded successfully!
                </div>
            @endif

            @if(Session::has('delete_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>Great!</strong> The image was deleted successfully!
                </div>
            @endif

            <h1 class="mb-4 text-xl font-semibold">Manage images</h1>

            <p class="mb-2">
                To include these images in a post, simply copy/paste the markdown or copy the URL.
            </p>

            <a href="{{route('media.create')}}" class="text-blue-800 mb-2 block underline">Upload an image</a>

            @foreach($images as $image)

                <div class="flex mb-4 flex-col md:flex-row">

                    <img src="{{asset($image->getPathname())}}" class="w-full md:w-1/6 mr-2">

                    <div class="w-5/6">
                        <h4>Markdown</h4>
                        <p class="text-sm bg-gray-400 block p-2">!["{{\FlatFileCms\Media::filenameToTitle($image->getFilename())}}"](/{{$image->getPathname()}})</p>

                        <h4 class="mt-2">As URL</h4>

                        <p class="text-sm">{{asset($image->getPathname())}}</p>
                    </div>

                </div>

            @endforeach

        </section>

        <section>

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection
