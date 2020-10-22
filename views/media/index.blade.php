@extends('aloiacmsgui::template')

@section('content')

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

    <div class="bg-green-200 text-theme-darkest p-4 rounded mb-8 fixed bottom-0 duration-200 hidden mr-4 shadow" id="copied_alert">
        <strong class="font-black">{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::images.copied_url')}}
    </div>

    <h1 class="mb-4 text-xl font-semibold">{{trans('aloiacmsgui::images.manage')}}</h1>

    <p class="mb-2">
        {{trans('aloiacmsgui::images.include_in_post')}}
    </p>

    <a href="{{route('media.create')}}" class="text-blue-800 mb-2 block underline">{{trans('aloiacmsgui::images.upload_new')}}</a>

    @foreach($images->chunk(4) as $image_chunk)

        <div class="w-full flex flex-row space-x-2">

            @foreach($image_chunk as $image)

                <div class="flex-1 mb-4">

                    <img src="{{asset($image->getPathname())}}"
                         class="w-full h-auto object-contain rounded cursor-pointer"
                         onclick="copyStringToClipboard('/{{$image->getPathname()}}');showAlert()">

                    <span>{{basename($image->getPathname())}}</span>

                </div>

            @endforeach

        </div>

    @endforeach

@endsection

@push('scripts')
    <script rel="text/javascript">
        function copyStringToClipboard (str) {
            // Create new element
            var el = document.createElement('textarea');
            // Set value (string to be copied)
            el.value = str;
            // Set non-editable to avoid focus and move outside of view
            el.setAttribute('readonly', '');
            el.style = {position: 'absolute', left: '-9999px'};
            document.body.appendChild(el);
            // Select text inside element
            el.select();
            // Copy text to clipboard
            document.execCommand('copy');
            // Remove temporary element
            document.body.removeChild(el);
        }

        function showAlert() {
            var el = document.getElementById('copied_alert');
            el.classList.remove('hidden');

            setTimeout(function() {
                el.classList.add('hidden');
            }, 3000);
        }
    </script>
@endpush
