@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{_translate('CREATE_CONTENT_BLOCK')}}</h1>

    <label class="label">
        {{_translate('PAGE_TYPE')}}
    </label>

    <p>
        {{_translate('CURRENTLY_USING')}}: <strong>{{$file_type}}</strong>.
    </p>

    {{_translate('CHANGE_TO')}}:

    @if($file_type !== 'md')
        <a href="{{route(Route::currentRouteName(), ['file_type' => 'md'])}}" class="text-blue-800 underline">Markdown</a>
    @endif

    @if($file_type !== 'html')
        <a href="{{route(Route::currentRouteName(), ['file_type' => 'html'])}}" class="text-blue-800 underline">HTML</a>
    @endif
    
    <form action="{{route('content-blocks.store')}}" method="post">

        {!! csrf_field() !!}

        <input type="hidden" name="file_type" value="{{$file_type}}" />

        <div class="mb-4">
            <label for="name" class="label">{{_translate('BLOCK_NAME')}}</label>
            <input type="text" name="name" placeholder="{{_translate('BLOCK_NAME')}}" class="text-field" required/>
        </div>

        <div class="mb-4">
            <label for="content" class="label">{{_translate('CONTENT')}}</label>
            @if($file_type === 'html')
                @include('flatfilecmsgui::blocks.ckeditor', ['name' => 'content', 'value' => null])
            @else
                @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
            @endif
        </div>

        <button type="submit" class="bg-green-600 text-white rounded p-4 my-4">
            {{_translate('CREATE_CONTENT_BLOCK')}}
        </button>

    </form>

@endsection
