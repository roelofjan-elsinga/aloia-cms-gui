@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">Maak een content block</h1>

    <label class="label">
        Page type
    </label>

    <p>
        Currently you're using: <strong>{{$file_type}}</strong>.
    </p>

    You can change to:

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
            <label for="name" class="label">Block name</label>
            <input type="text" name="name" placeholder="Block name" class="text-field" required/>
        </div>

        <div class="mb-4">
            <label for="content" class="label">Content</label>
            @if($file_type === 'html')
                @include('flatfilecmsgui::blocks.ckeditor', ['name' => 'content', 'value' => null])
            @else
                @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
            @endif
        </div>

        <button type="submit" class="bg-green-600 text-white rounded p-4 my-4">
            Create content block
        </button>

    </form>

@endsection
