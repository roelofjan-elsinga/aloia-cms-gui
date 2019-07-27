@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">Create a new page</h1>

    {!! Form::open(['route' => 'pages.store', 'method' => 'post']) !!}

    <div class="flex">

        <section class="w-2/3 pr-4">

            {!! Form::hidden('scheduled', "0") !!}
            {!! Form::hidden('thumbnail', null) !!}
            {!! Form::hidden('post_date', null) !!}
            {!! Form::hidden('file_type', $file_type) !!}
            {!! Form::hidden('template_name', $template_name) !!}

            {!! Form::label('title', 'Page title *', ['class' => 'label']) !!}
            {!! Form::text('title', null, ['class' => 'text-field']) !!}

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

            {!! Form::label('slug', 'URL *', ['class' => 'label']) !!}
            {!! Form::text('slug', null, ['class' => 'text-field', 'placeholder' => 'example-url']) !!}

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

            <div class="my-4">
                {!! Form::hidden('is_homepage', "0") !!}

                {!! Form::checkbox('is_homepage', "1", false) !!}

                {!! Form::label('is_homepage', 'Page is homepage') !!}
            </div>

            * = Required

            <div class="text-left">
                {!! Form::submit('Create page', ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
            </div>

        </section>

        <section class="w-1/3 bg-gray-200 p-4 rounded-lg mb-8">

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

            {{--{!! Form::label('template_name', 'Page Template *', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('template_name', $template_name, ['class' => 'text-field']) !!}--}}

            {!! Form::label('description', 'SEO Description * ', ['class' => 'label']) !!}
            {!! Form::textarea('description', null, ['class' => 'text-field', 'rows' => 5]) !!}

            {!! Form::label('summary', 'SEO Summary * ', ['class' => 'label']) !!}
            {!! Form::textarea('summary', null, ['class' => 'text-field', 'rows' => 3]) !!}

            {{--{!! Form::label('keywords', 'Keywords', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('keywords', null, ['class' => 'text-field']) !!}--}}

            {{--{!! Form::label('author', 'Author', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('author', null, ['class' => 'text-field']) !!}--}}

            {{--{!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('canonical', null, ['class' => 'text-field']) !!}--}}

            {!! Form::label('image', 'Image URL for social media', ['class' => 'label']) !!}
            {!! Form::text('image', null, ['class' => 'text-field']) !!}

        </section>

    </div>

    {!! Form::close() !!}

@endsection()
