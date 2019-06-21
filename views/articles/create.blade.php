@extends('admin::template')

@section('content')

    <h1 class="mb-8">Create article</h1>

    {!! Form::open(['route' => 'article.store', 'method' => 'post']) !!}

    {!! Form::label('slug', 'URL', ['class' => 'label']) !!}
    {!! Form::text('slug', null, ['class' => 'text-field']) !!}

    <div class="flex">
        <label class="label flex-1">Content</label>
        <div class="flex-1 text-right">
            <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">Get images for this post</a>
        </div>
    </div>

    <div class="mb-4">
        @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
    </div>

    {!! Form::label('description', 'Description', ['class' => 'label']) !!}
    {!! Form::textarea('description', null, ['class' => 'text-field', 'rows' => 5]) !!}

    {!! Form::label('post_date', 'Post date', ['class' => 'label']) !!}
    {!! Form::date('post_date', null, ['class' => 'text-field']) !!}

    <div class="my-4">
        {!! Form::hidden('published', "0") !!}

        {!! Form::checkbox('published', "1", false) !!}

        {!! Form::label('published', 'Article is published') !!}
    </div>

    <div class="my-4">
        {!! Form::hidden('scheduled', "0") !!}

        {!! Form::checkbox('scheduled', "1", false) !!}

        {!! Form::label('scheduled', 'Article is scheduled') !!}
    </div>

    <div class="text-right">
        {!! Form::submit('Create article', ['class' => 'bg-green-dark text-white rounded p-4 my-4']) !!}
    </div>

    {!! Form::close() !!}

@endsection()
