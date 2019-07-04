@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">Create a new page</h1>

    {!! Form::open(['route' => 'pages.create', 'method' => 'get']) !!}

    <label for="file_type" class="label">Page type</label>
    <div class="flex">
        <select name="file_type" class="text-field">
            <option value="html" {{$file_type === 'html' ? 'selected' : ''}}>HTML</option>
            <option value="md" {{$file_type === 'md' ? 'selected' : ''}}>Markdown</option>
        </select>
        <button type="submit" class="bg-blue-800 text-white rounded p-4 rounded-l-none">
            Select
        </button>
    </div>

    {!! Form::close() !!}

    {!! Form::open(['route' => 'pages.store', 'method' => 'post']) !!}

    {!! Form::hidden('scheduled', "0") !!}
    {!! Form::hidden('thumbnail', null) !!}
    {!! Form::hidden('post_date', null) !!}
    {!! Form::hidden('file_type', $file_type) !!}

    {!! Form::label('title', 'Page title *', ['class' => 'label']) !!}
    {!! Form::text('title', null, ['class' => 'text-field']) !!}

    {!! Form::label('slug', 'URL *', ['class' => 'label']) !!}
    {!! Form::text('slug', null, ['class' => 'text-field']) !!}

    {!! Form::label('template_name', 'Page Template *', ['class' => 'label']) !!}
    {!! Form::text('template_name', $template_name, ['class' => 'text-field']) !!}

    <div class="flex">
        <label class="label flex-1">Content</label>
        <div class="flex-1 text-right">
            <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">Get images for this post</a>
        </div>
    </div>

    <div class="mb-4">
        @if($file_type === 'html')
            @include('flatfilecmsgui::blocks.ckeditor', ['name' => 'content', 'value' => null])
        @else
            @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
        @endif
    </div>

    {!! Form::label('description', 'Description * ', ['class' => 'label']) !!}
    {!! Form::textarea('description', null, ['class' => 'text-field', 'rows' => 5]) !!}

    {!! Form::label('summary', 'Summary * ', ['class' => 'label']) !!}
    {!! Form::textarea('summary', null, ['class' => 'text-field', 'rows' => 3]) !!}

    {!! Form::label('keywords', 'Keywords', ['class' => 'label']) !!}
    {!! Form::text('keywords', null, ['class' => 'text-field']) !!}

    {!! Form::label('author', 'Author', ['class' => 'label']) !!}
    {!! Form::text('author', null, ['class' => 'text-field']) !!}

    {!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}
    {!! Form::text('canonical', null, ['class' => 'text-field']) !!}

    {!! Form::label('image', 'Image URL (shown in previews on social media)', ['class' => 'label']) !!}
    {!! Form::text('image', null, ['class' => 'text-field']) !!}

    <div class="my-4">
        {!! Form::hidden('published', "0") !!}

        {!! Form::checkbox('published', "1", false) !!}

        {!! Form::label('published', 'Page is published') !!}
    </div>
    
    <div class="my-4">
        {!! Form::hidden('in_menu', "0") !!}

        {!! Form::checkbox('in_menu', "1", false) !!}

        {!! Form::label('in_menu', 'Page is in menu') !!}
    </div>

    * = Required

    <div class="text-right">
        {!! Form::submit('Create article', ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
    </div>

    {!! Form::close() !!}

@endsection()
