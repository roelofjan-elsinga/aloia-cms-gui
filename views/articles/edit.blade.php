@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::articles.edit', ['title' => $article->title()])}}</h1>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-8">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>Warning!</strong> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($article, ['route' => ['articles.update', $article->slug()], 'method' => 'put']) !!}

    {!! Form::hidden('file_type', $article->extension()) !!}

    {!! Form::hidden('original_slug', $article->slug()) !!}
    {!! Form::label('slug', 'URL *', ['class' => 'label']) !!}
    {!! Form::text('slug', $article->slug(), ['class' => 'text-field', 'placeholder' => trans('aloiacmsgui::articles.example_url'), 'required' => 'required']) !!}

    <div class="flex">
        <label class="label flex-1">{{trans('aloiacmsgui::articles.content')}} *</label>
        <div class="flex-1 text-right">
            <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{trans('aloiacmsgui::images.for_post')}}</a>
        </div>
    </div>

    <div class="mb-4">
        @if($file_type === 'html')
            @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $article->rawBody()])
        @else
            @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => $article->rawBody()])
        @endif
    </div>

    {!! Form::label('description', trans('aloiacmsgui::articles.description') . ' *', ['class' => 'label']) !!}
    {!! Form::textarea('description', $article->description(), ['class' => 'text-field', 'rows' => 5, 'required' => 'required']) !!}

    {!! Form::label('post_date', trans('aloiacmsgui::articles.post_date') . ' *', ['class' => 'label']) !!}
    {!! Form::date('post_date', $article->getPostDate(), ['class' => 'text-field']) !!}

    <div class="my-4">
        {!! Form::hidden('is_published', "0") !!}

        {!! Form::checkbox('is_published', "1", $article->isPublished()) !!}

        {!! Form::label('is_published', trans('aloiacmsgui::articles.is_published')) !!}
    </div>

    <div class="my-4">
        {!! Form::hidden('is_scheduled', "0") !!}

        {!! Form::checkbox('is_scheduled', "1", $article->isScheduled()) !!}

        {!! Form::label('is_scheduled', trans('aloiacmsgui::articles.is_scheduled')) !!}
    </div>

    * = {{trans('aloiacmsgui::pages.required')}}

    <div class="text-right">
        {!! Form::submit(trans('aloiacmsgui::articles.update'), ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
    </div>

    {!! Form::close() !!}

    <div class="">
        {!! Form::open(['route' => ['articles.destroy', $article->slug()], 'method' => 'delete']) !!}

        <button type="submit" class="link text-red-500" onclick="return confirm('Are you sure you want to delete this item?');">Delete this article</button>

        {!! Form::close() !!}
    </div>

@endsection
