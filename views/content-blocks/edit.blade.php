@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{_translate_dynamic('EDIT_CONTENT_BLOCK', $name)}}</h1>

    <form action="{{route('content-blocks.update', $name)}}" method="post">

        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PUT" />

        <div class="mb-4">
            @if($extension === 'html')
                @include('flatfilecmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $content])
            @else
                @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => $content])
            @endif
        </div>

        <button class="bg-green-600 text-white rounded p-4 my-4">{{_translate('UPDATE_CONTENT_BLOCK')}}</button>

    </form>

@endsection
