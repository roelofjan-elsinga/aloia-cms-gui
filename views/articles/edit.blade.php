@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">Edit "{{$article->title}}"</h1>

    {!! Form::model($article, ['route' => 'article.update', 'method' => 'put']) !!}

    {!! Form::hidden('original_slug', $article->slug()) !!}
    {!! Form::label('slug', 'URL', ['class' => 'label']) !!}
    {!! Form::text('slug', $article->slug(), ['class' => 'text-field']) !!}

    <div class="flex">
        <label class="label flex-1">Content</label>
        <div class="flex-1 text-right">
            <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">Get images for this post</a>
        </div>
    </div>

    <div class="mb-4">
        @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => $article->rawContent()])
    </div>

    {!! Form::label('description', 'Description', ['class' => 'label']) !!}
    {!! Form::textarea('description', $article->description(), ['class' => 'text-field', 'rows' => 5]) !!}

    {!! Form::label('post_date', 'Post date', ['class' => 'label']) !!}
    {!! Form::date('post_date', $article->rawPostDate, ['class' => 'text-field']) !!}

    <div class="my-4">
        {!! Form::hidden('published', "0") !!}

        {!! Form::checkbox('published', "1", $article->isPublished) !!}

        {!! Form::label('published', 'Article is published') !!}
    </div>

    <div class="my-4">
        {!! Form::hidden('scheduled', "0") !!}

        {!! Form::checkbox('scheduled', "1", $article->isScheduled) !!}

        {!! Form::label('scheduled', 'Article is scheduled') !!}
    </div>

    <div class="text-right">
        {!! Form::submit('Update article', ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
    </div>

    {!! Form::close() !!}

@endsection
