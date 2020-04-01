@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::content_blocks.create')}}</h1>

    <label class="label">
        {{trans('aloiacmsgui::pages.type')}}
    </label>

    <p>
        {{trans('aloiacmsgui::interface.currently_using')}}: <strong>{{$file_type}}</strong>.
    </p>

    {{trans('aloiacmsgui::interface.change_to')}}:

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
            <label for="name" class="label">{{trans('aloiacmsgui::content_blocks.name')}}</label>
            <input type="text" name="name" placeholder="{{trans('aloiacmsgui::content_blocks.name')}}" class="text-field" required/>
        </div>

        <div class="mb-4">
            <label for="content" class="label">{{trans('aloiacmsgui::articles.content')}}</label>
            @if($file_type === 'html')
                @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => null])
            @else
                @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
            @endif
        </div>

        <button type="submit" class="bg-green-600 text-white rounded p-4 my-4">
            {{trans('aloiacmsgui::content_blocks.create')}}
        </button>

    </form>

@endsection
