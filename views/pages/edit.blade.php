@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{_translate_dynamic('EDIT_ARTICLE', $page_resource->title())}}</h1>

    {!! Form::open(['route' => ['pages.update', $page_resource->slug()], 'method' => 'put']) !!}

    <div class="flex">
        <section class="w-2/3 pr-4">

            {!! Form::hidden('file_type', $file_type) !!}
            {!! Form::hidden('scheduled', $page_resource->isScheduled() ? "1" : "0") !!}
            {!! Form::hidden('thumbnail', null) !!}
            {!! Form::hidden('post_date', null) !!}
            {!! Form::hidden('template_name', $page_resource->templateName()) !!}

            {!! Form::label('title', _translate('PAGE_TITLE') . ' *', ['class' => 'label']) !!}
            {!! Form::text('title', $page_resource->title(), ['class' => 'text-field']) !!}

            <div class="flex">
                <label class="label flex-1">{{_translate('CONTENT')}}</label>
                <div class="flex-1 text-right">
                    <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{_translate('IMAGES_FOR_POST')}}</a>
                </div>
            </div>

            <div class="mb-4">
                @if($file_type === 'html')
                    @include('flatfilecmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $page_resource->rawContent()])
                @else
                    @include('flatfilecmsgui::blocks.simplemde', ['name' => 'content', 'value' => $page_resource->rawContent()])
                @endif
            </div>

            {!! Form::hidden('original_slug', $page_resource->slug()) !!}
            {!! Form::label('slug', 'URL *', ['class' => 'label', 'placeholder' => 'example-url']) !!}
            {!! Form::text('slug', $page_resource->slug(), ['class' => 'text-field', 'placeholder' => _translate('EXAMPLE_URL_PLACEHOLDER')]) !!}

            <div class="my-4">
                {!! Form::hidden('published', "0") !!}

                {!! Form::checkbox('published', "1", $page_resource->isPublished()) !!}

                {!! Form::label('published', _translate('PAGE_IS_PUBLISHED')) !!}
            </div>

            <div class="my-4">
                {!! Form::hidden('in_menu', "0") !!}

                {!! Form::checkbox('in_menu', "1", $page_resource->isInMenu()) !!}

                {!! Form::label('in_menu', _translate('PAGE_IS_IN_MENU')) !!}
            </div>

            <div class="my-4">
                {!! Form::hidden('is_homepage', "0") !!}

                {!! Form::checkbox('is_homepage', "1", $page_resource->isHomepage()) !!}

                {!! Form::label('is_homepage', _translate('PAGE_IS_HOMEPAGE')) !!}
            </div>

            * = {{_translate('REQUIRED')}}

            <div class="text-left">
                {!! Form::submit(_translate('UPDATE_PAGE'), ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
            </div>

        </section>

        <section class="w-1/3 bg-gray-200 p-4 rounded-lg mb-8">

            {{--{!! Form::label('template_name', 'Page Template *', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('template_name', $page_resource->templateName(), ['class' => 'text-field']) !!}--}}

            {!! Form::label('description', _translate('SEO_DESCRIPTION') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('description', $page_resource->description(), ['class' => 'text-field', 'rows' => 5]) !!}

            {!! Form::label('summary', _translate('SEO_SUMMARY') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('summary', $page_resource->summary(), ['class' => 'text-field', 'rows' => 3]) !!}

            {{--{!! Form::label('keywords', 'Keywords', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('keywords', $page_resource->keywords(), ['class' => 'text-field']) !!}--}}

            {{--{!! Form::label('author', 'Author', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('author', $page_resource->author(), ['class' => 'text-field']) !!}--}}

            {{--{!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('canonical', $page_resource->canonicalLink(), ['class' => 'text-field']) !!}--}}

            <label for="category" class="label">{{_translate('PAGE_CATEGORY')}}</label>
            <select name="category" class="text-field">

                @include('flatfilecmsgui::taxonomy.nested-categories', ['taxonomies' => $categories, 'selected' => $page_resource->category()])

            </select>

            <a href="{{route('taxonomy.index')}}" class="underline" target="_blank">{{_translate('MANAGE_TAXONOMY')}}</a>

            {!! Form::label('image', _translate('IMAGE_FOR_SOCIAL_MEDIA'), ['class' => 'label']) !!}
            {!! Form::text('image', $page_resource->image(), ['class' => 'text-field']) !!}

        </section>

    </div>

    {!! Form::close() !!}

@endsection()
