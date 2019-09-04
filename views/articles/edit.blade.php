@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{_translate_dynamic('EDIT_ARTICLE', $article->title)}}</h1>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-8">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>Warning!</strong> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($article, ['route' => ['articles.update', $article->slug], 'method' => 'put']) !!}

    {!! Form::hidden('file_type', $article->fileType()) !!}

    {!! Form::hidden('original_slug', $article->slug()) !!}
    {!! Form::label('slug', 'URL *', ['class' => 'label']) !!}
    {!! Form::text('slug', $article->slug(), ['class' => 'text-field', 'placeholder' => _translate('EXAMPLE_URL_PLACEHOLDER'), 'required' => 'required']) !!}

    <div class="flex">
        <label class="label flex-1">{{_translate('CONTENT')}} *</label>
        <div class="flex-1 text-right">
            <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{_translate('IMAGES_FOR_POST')}}</a>
        </div>
    </div>

    <div class="mb-4">
        @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => $article->rawContent()])
    </div>

    {!! Form::label('description', _translate('DESCRIPTION') . ' *', ['class' => 'label']) !!}
    {!! Form::textarea('description', $article->description(), ['class' => 'text-field', 'rows' => 5, 'required' => 'required']) !!}

    {!! Form::label('post_date', _translate('POST_DATE') . ' *', ['class' => 'label']) !!}
    {!! Form::date('post_date', $article->rawPostDate, ['class' => 'text-field']) !!}

    <div class="my-4">
        {!! Form::hidden('published', "0") !!}

        {!! Form::checkbox('published', "1", $article->isPublished) !!}

        {!! Form::label('published', _translate('ARTICLE_IS_PUBLISHED')) !!}
    </div>

    <div class="my-4">
        {!! Form::hidden('scheduled', "0") !!}

        {!! Form::checkbox('scheduled', "1", $article->isScheduled) !!}

        {!! Form::label('scheduled', _translate('ARTICLE_IS_SCHEDULED')) !!}
    </div>

    * = {{_translate('REQUIRED')}}

    <div class="text-right">
        {!! Form::submit(_translate('UPDATE_ARTICLE'), ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
    </div>

    {!! Form::close() !!}

    <div class="">
        {!! Form::open(['route' => ['articles.destroy', $article->slug], 'method' => 'delete']) !!}

        <button type="submit" class="link text-red-500" onclick="return confirm('Are you sure you want to delete this item?');">Delete this article</button>

        {!! Form::close() !!}
    </div>

@endsection
