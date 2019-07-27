@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">Edit "{{$name}}" content block</h1>

    <form action="{{route('content-blocks.update', $name)}}" method="post">

        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PUT" />
        <input type="hidden" name="file_path" value="{{$file_path}}" />

        <div class="mb-4">
            @if($extension === 'html')
                @include('flatfilecmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $content])
            @else
                @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => $content])
            @endif
        </div>

        <button class="bg-green-600 text-white rounded p-4 my-4">Update content block</button>

    </form>

@endsection
