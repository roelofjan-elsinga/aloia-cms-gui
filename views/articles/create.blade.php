@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{_translate('CREATE_ARTICLE')}}</h1>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-8">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>Warning!</strong> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'articles.store', 'method' => 'post']) !!}

    {!! Form::hidden('file_type', $file_type) !!}

    {!! Form::label('slug', 'URL *', ['class' => 'label']) !!}
    {!! Form::text('slug', null, ['class' => 'text-field', 'placeholder' => _translate('EXAMPLE_URL_PLACEHOLDER'), 'required' => 'required']) !!}

    <div class="flex">
        <label class="label">{{_translate('CONTENT')}} *</label>
        <div class="flex-1 text-right">
            <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{_translate('IMAGES_FOR_POST')}}</a>
        </div>
    </div>

    <div class="flex-1">
        @if($file_type !== 'md')
            <a href="{{route(Route::currentRouteName(), ['file_type' => 'md'])}}" class="text-blue-800 underline">Use Markdown editor</a>
        @endif

        @if($file_type !== 'html')
            <a href="{{route(Route::currentRouteName(), ['file_type' => 'html'])}}" class="text-blue-800 underline">Use HTML editor</a>
        @endif
    </div>

    <div class="mb-4">
        @if($file_type === 'html')
            @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => null])
        @else
            @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
        @endif
    </div>

    {!! Form::label('description', _translate('DESCRIPTION') . ' *', ['class' => 'label']) !!}
    {!! Form::textarea('description', null, ['class' => 'text-field', 'rows' => 5, 'required' => 'required']) !!}

    {!! Form::label('post_date', _translate('POST_DATE') . ' *', ['class' => 'label']) !!}
    {!! Form::date('post_date', null, ['class' => 'text-field']) !!}

    <div class="my-4">
        {!! Form::hidden('is_published', "0") !!}

        {!! Form::checkbox('is_published', "1", false) !!}

        {!! Form::label('is_published', _translate('ARTICLE_IS_PUBLISHED')) !!}
    </div>

    <div class="my-4">
        {!! Form::hidden('is_scheduled', "0") !!}

        {!! Form::checkbox('is_scheduled', "1", false) !!}

        {!! Form::label('is_scheduled', _translate('ARTICLE_IS_SCHEDULED')) !!}
    </div>

    * = {{_translate('REQUIRED')}}

    <div class="text-right">
        {!! Form::submit(_translate('CREATE_ARTICLE'), ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
    </div>

    {!! Form::close() !!}

@endsection()
