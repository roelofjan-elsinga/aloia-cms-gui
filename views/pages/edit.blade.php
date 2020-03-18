@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{_translate_dynamic('EDIT_ARTICLE', $page_resource->title())}}</h1>

    @include("aloiacmsgui::blocks.error-message")

    {!! Form::open(['route' => ['pages.update', $page_resource->url()], 'method' => 'put']) !!}

    <div class="flex">
        <section class="w-2/3 pr-4">

            {!! Form::hidden('file_type', $file_type) !!}
            {!! Form::hidden('scheduled', $page_resource->isScheduled() ? "1" : "0") !!}
            {!! Form::hidden('thumbnail', null) !!}
            {!! Form::hidden('post_date', null) !!}
            {!! Form::hidden('template_name', $page_resource->templateName()) !!}
            {!! Form::hidden('meta_data', !is_null($page_resource->metaData()) ? json_encode($page_resource->metaData()) : null) !!}

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
                    @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $page_resource->rawBody()])
                @else
                    @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => $page_resource->rawBody()])
                @endif
            </div>

            {!! Form::hidden('original_url', $page_resource->url()) !!}
            {!! Form::label('url', 'URL *', ['class' => 'label', 'placeholder' => 'example-url']) !!}
            {!! Form::text('url', $page_resource->url(), ['class' => 'text-field', 'placeholder' => _translate('EXAMPLE_URL_PLACEHOLDER')]) !!}

            <div class="my-4">
                {!! Form::hidden('is_published', "0") !!}

                {!! Form::checkbox('is_published', "1", $page_resource->isPublished()) !!}

                {!! Form::label('is_published', _translate('PAGE_IS_PUBLISHED')) !!}
            </div>

            <div class="my-4">
                {!! Form::hidden('in_menu', "0") !!}

                {!! Form::checkbox('in_menu', "1", $page_resource->isInMenu()) !!}

                {!! Form::label('in_menu', _translate('PAGE_IS_IN_MENU')) !!}

                <div id="menu_name" style="display: {{ $page_resource->isInMenu() ? 'block' : 'none'}};">
                    {!! Form::label('menu_name', _translate('MENU_NAME'), ['class' => 'label']) !!}
                    {!! Form::text('menu_name', $page_resource->menuName(), ['class' => 'text-field', 'placeholder' => _translate('MENU_NAME')]) !!}
                </div>

                <script>
                    function triggerMenuNameField(event) {

                        document.getElementById('menu_name').style.display = 'none';

                        if(event.checked) {

                            document.getElementById('menu_name').style.display = 'block';

                        }
                    }
                </script>
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

            {!! Form::label('description', _translate('SEO_DESCRIPTION') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('description', $page_resource->description(), ['class' => 'text-field', 'rows' => 5]) !!}

            {!! Form::label('summary', _translate('SEO_SUMMARY') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('summary', $page_resource->summary(), ['class' => 'text-field', 'rows' => 3]) !!}

            {!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}
            {!! Form::text('canonical', $page_resource->canonicalLink(), ['class' => 'text-field']) !!}

            {!! Form::label('image', _translate('IMAGE_FOR_SOCIAL_MEDIA'), ['class' => 'label']) !!}
            {!! Form::text('image', $page_resource->image(), ['class' => 'text-field']) !!}

            {!! Form::label('sidebar', _translate('SIDEBAR_BLOCKS'), ['class' => 'label']) !!}
            {!! Form::textarea('sidebar', $page_resource->metaData()['sidebar'] ?? "", ['class' => 'text-field', 'rows' => 5]) !!}
        </section>

    </div>

    {!! Form::close() !!}

    <div class="">
        {!! Form::open(['route' => ['pages.destroy', $page_resource->url()], 'method' => 'delete']) !!}

        <button type="submit" class="link text-red-500" onclick="return confirm('Are you sure you want to delete this item?');">Delete this page</button>

        {!! Form::close() !!}
    </div>

@endsection()
