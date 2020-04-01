@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::pages.create_new')}}</h1>

    @include("aloiacmsgui::blocks.error-message")

    {!! Form::open(['route' => 'pages.store', 'method' => 'post']) !!}

    <div class="flex">

        <section class="w-2/3 pr-4">

            {!! Form::hidden('scheduled', "0") !!}
            {!! Form::hidden('thumbnail', null) !!}
            {!! Form::hidden('post_date', null) !!}
            {!! Form::hidden('file_type', $file_type) !!}
            {!! Form::hidden('template_name', $template_name) !!}

            {!! Form::label('title', trans('aloiacmsgui::pages.title') . ' *', ['class' => 'label']) !!}
            {!! Form::text('title', null, ['class' => 'text-field']) !!}

            <div class="flex">
                <label class="label flex-1">{{trans('aloiacmsgui::articles.content')}}</label>
                <div class="flex-1 text-right">
                    <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{trans('aloiacmsgui::images.for_post')}}</a>
                </div>
            </div>

            <div class="mb-4">
                @if($file_type === 'html')
                    @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => null])
                @else
                    @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
                @endif
            </div>

            {!! Form::label('url', 'URL *', ['class' => 'label']) !!}
            {!! Form::text('url', null, ['class' => 'text-field', 'placeholder' => trans('aloiacmsgui::articles.example_url')]) !!}

            <div class="my-4">
                {!! Form::hidden('is_published', "0") !!}

                {!! Form::checkbox('is_published', "1", false) !!}

                {!! Form::label('is_published', trans('aloiacmsgui::pages.is_published')) !!}
            </div>

            <div class="my-4">
                {!! Form::hidden('in_menu', "0") !!}

                {!! Form::checkbox('in_menu', "1", false, ['onchange' => 'triggerMenuNameField(this)']) !!}

                {!! Form::label('in_menu', trans('PAGE_aloiacmsgui::interface.in_menu')) !!}

                <div id="menu_name" style="display: none;">
                    {!! Form::label('menu_name', trans('aloiacmsgui::interface.menu_name'), ['class' => 'label']) !!}
                    {!! Form::text('menu_name', null, ['class' => 'text-field', 'placeholder' => trans('aloiacmsgui::interface.menu_name')]) !!}
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

                {!! Form::checkbox('is_homepage', "1", false) !!}

                {!! Form::label('is_homepage', trans('aloiacmsgui::pages.is_homepage')) !!}
            </div>

            * = {{trans('aloiacmsgui::pages.required')}}

            <div class="text-left">
                {!! Form::submit(trans('aloiacmsgui::pages.create'), ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
            </div>

        </section>

        <section class="w-1/3 bg-gray-200 p-4 rounded-lg mb-8">

            <label class="label">
                {{trans("aloiacmsgui::pages.type")}}
            </label>

            <p>
                {{trans('aloiacmsgui::interface.currently_using')}}: <strong>{{$file_type}}</strong>.
            </p>

            {{trans('aloiacmsgui::interface.change_to')}}:

            @if($file_type !== 'md')
                <a href="{{route(Route::currentRouteName(), ['file_type' => 'md'])}}" class="text-blue-800 underline">Markdown</a>
            @endif

            @if($file_type !== 'html')
                <a href="{{route(Route::currentRouteName(), ['file_type' => 'html'])}}" class="text-blue-800 underline">HTML</a>
            @endif

            {!! Form::label('description', trans('aloiacmsgui::pages.seo_description') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('description', null, ['class' => 'text-field', 'rows' => 5]) !!}

            {!! Form::label('summary', trans('aloiacmsgui::pages.seo_summary') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('summary', null, ['class' => 'text-field', 'rows' => 3]) !!}

            {!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}
            {!! Form::text('canonical', null, ['class' => 'text-field']) !!}

            {!! Form::label('image', trans('aloiacmsgui::pages.social_media_image'), ['class' => 'label']) !!}
            {!! Form::text('image', null, ['class' => 'text-field']) !!}

            {!! Form::label('sidebar', trans('aloiacmsgui::pages.sidebar_blocks'), ['class' => 'label']) !!}
            {!! Form::textarea('sidebar', null, ['class' => 'text-field', 'rows' => 5]) !!}

        </section>

    </div>

    {!! Form::close() !!}

@endsection()
