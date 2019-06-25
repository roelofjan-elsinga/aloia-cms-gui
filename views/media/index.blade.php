@extends('flatfilecmsgui::template')

@section('content')

    @if(session()->has('upload_success'))
        <div class="bg-green-dark text-white p-4 rounded mb-4">
            <strong>Great!</strong> The image was uploaded successfully!
        </div>
    @endif

    @if(session()->has('delete_success'))
        <div class="bg-green-dark text-white p-4 rounded mb-4">
            <strong>Great!</strong> The image was deleted successfully!
        </div>
    @endif

    <h1 class="mb-4">Manage images</h1>

    <p class="mb-2">
        To include these images in a post, simply copy/paste the markdown or copy the URL.
    </p>

    <a href="{{route('media.create')}}" class="text-blue-darker mb-2 block">Upload an image</a>

    @foreach($images as $image)

        <div class="flex mb-4 flex-col md:flex-row">

            <img src="{{asset($image->getPathname())}}" class="w-full md:w-1/6 mr-2">

            <div class="w-5/6">
                <h4>Markdown</h4>
                <p class="text-sm bg-grey-light block p-2">!["{{\FlatFileCms\Media::filenameToTitle($image->getFilename())}}"](/{{$image->getPathname()}})</p>

                <h4 class="mt-2">As URL</h4>

                <p class="text-sm">{{asset($image->getPathname())}}</p>
            </div>

        </div>

    @endforeach

@endsection
