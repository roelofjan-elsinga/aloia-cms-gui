@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::articles.edit', ['title' => $page_resource->title()])}}</h1>

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

            {!! Form::label('title', trans('aloiacmsgui::pages.title') . ' *', ['class' => 'label']) !!}
            {!! Form::text('title', $page_resource->title(), ['class' => 'text-field']) !!}

            <div class="flex">
                <label class="label flex-1">{{trans('aloiacmsgui::articles.content')}}</label>
                <div class="flex-1 text-right">
                    <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{trans('aloiacmsgui::images.for_post')}}</a>
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
            {!! Form::text('url', $page_resource->url(), ['class' => 'text-field', 'placeholder' => trans('aloiacmsgui::articles.example_url')]) !!}

            <div class="my-4">
                {!! Form::hidden('is_published', "0") !!}

                {!! Form::checkbox('is_published', "1", $page_resource->isPublished()) !!}

                {!! Form::label('is_published', trans('aloiacmsgui::pages.is_published')) !!}
            </div>

            <div class="my-4">
                {!! Form::hidden('in_menu', "0") !!}

                {!! Form::checkbox('in_menu', "1", $page_resource->isInMenu()) !!}

                {!! Form::label('in_menu', trans('aloiacmsgui::pages.in_menu')) !!}

                <div id="menu_name" style="display: {{ $page_resource->isInMenu() ? 'block' : 'none'}};">
                    {!! Form::label('menu_name', trans('aloiacmsgui::interface.menu_name'), ['class' => 'label']) !!}
                    {!! Form::text('menu_name', $page_resource->menuName(), ['class' => 'text-field', 'placeholder' => trans('aloiacmsgui::interface.menu_name')]) !!}
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

                {!! Form::label('is_homepage', trans('aloiacmsgui::pages.is_homepage')) !!}
            </div>

            * = {{trans('aloiacmsgui::pages.required')}}

            <div class="text-left">
                {!! Form::submit(trans('aloiacmsgui::pages.update'), ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
            </div>

        </section>

        <section class="w-1/3 bg-gray-200 p-4 rounded-lg mb-8">

            {!! Form::label('description', trans('aloiacmsgui::pages.seo_description') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('description', $page_resource->description(), ['class' => 'text-field', 'rows' => 5]) !!}

            {!! Form::label('summary', trans('aloiacmsgui::pages.seo_summary') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('summary', $page_resource->summary(), ['class' => 'text-field', 'rows' => 3]) !!}

            {!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}
            {!! Form::text('canonical', $page_resource->canonicalLink(), ['class' => 'text-field']) !!}

            {!! Form::label('image', trans('aloiacmsgui::pages.social_media_image'), ['class' => 'label']) !!}
            {!! Form::text('image', $page_resource->image(), ['class' => 'text-field']) !!}

            {!! Form::label('sidebar', trans('aloiacmsgui::pages.sidebar_blocks'), ['class' => 'label']) !!}
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
