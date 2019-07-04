@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">Edit "{{$page_resource->title()}}"</h1>

    {!! Form::open(['route' => ['pages.update', $page_resource->slug()], 'method' => 'put']) !!}

    {!! Form::hidden('file_type', $file_type) !!}
    {!! Form::hidden('scheduled', $page_resource->isScheduled() ? "1" : "0") !!}
    {!! Form::hidden('thumbnail', null) !!}
    {!! Form::hidden('post_date', null) !!}

    {!! Form::label('title', 'Page title *', ['class' => 'label']) !!}
    {!! Form::text('title', $page_resource->title(), ['class' => 'text-field']) !!}

    {!! Form::hidden('original_slug', $page_resource->slug()) !!}
    {!! Form::label('slug', 'URL *', ['class' => 'label']) !!}
    {!! Form::text('slug', $page_resource->slug(), ['class' => 'text-field']) !!}

    {!! Form::label('template_name', 'Page Template *', ['class' => 'label']) !!}
    {!! Form::text('template_name', $page_resource->templateName(), ['class' => 'text-field']) !!}

    <div class="flex">
        <label class="label flex-1">Content</label>
        <div class="flex-1 text-right">
            <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">Get images for this post</a>
        </div>
    </div>

    <div class="mb-4">
        @if($file_type === 'html')
            @include('flatfilecmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $page_resource->rawContent()])
        @else
            @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => $page_resource->rawContent()])
        @endif
    </div>

    {!! Form::label('description', 'Description * ', ['class' => 'label']) !!}
    {!! Form::textarea('description', $page_resource->description(), ['class' => 'text-field', 'rows' => 5]) !!}

    {!! Form::label('summary', 'Summary * ', ['class' => 'label']) !!}
    {!! Form::textarea('summary', $page_resource->summary(), ['class' => 'text-field', 'rows' => 3]) !!}

    {!! Form::label('keywords', 'Keywords', ['class' => 'label']) !!}
    {!! Form::text('keywords', $page_resource->keywords(), ['class' => 'text-field']) !!}

    {!! Form::label('author', 'Author', ['class' => 'label']) !!}
    {!! Form::text('author', $page_resource->author(), ['class' => 'text-field']) !!}

    {!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}
    {!! Form::text('canonical', $page_resource->canonicalLink(), ['class' => 'text-field']) !!}

    {!! Form::label('image', 'Image URL (shown in previews on social media)', ['class' => 'label']) !!}
    {!! Form::text('image', $page_resource->image(), ['class' => 'text-field']) !!}

    <div class="my-4">
        {!! Form::hidden('published', "0") !!}

        {!! Form::checkbox('published', "1", $page_resource->isPublished()) !!}

        {!! Form::label('published', 'Page is published') !!}
    </div>

    <div class="my-4">
        {!! Form::hidden('in_menu', "0") !!}

        {!! Form::checkbox('in_menu', "1", $page_resource->isInMenu()) !!}

        {!! Form::label('in_menu', 'Page is in menu') !!}
    </div>

    * = Required

    <div class="text-right">
        {!! Form::submit('Save page', ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
    </div>

    {!! Form::close() !!}

@endsection()