@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{_translate('CREATE_NEW_PAGE')}}</h1>

    {!! Form::open(['route' => 'pages.store', 'method' => 'post']) !!}

    <div class="flex">

        <section class="w-2/3 pr-4">

            {!! Form::hidden('scheduled', "0") !!}
            {!! Form::hidden('thumbnail', null) !!}
            {!! Form::hidden('post_date', null) !!}
            {!! Form::hidden('file_type', $file_type) !!}
            {!! Form::hidden('template_name', $template_name) !!}

            {!! Form::label('title', _translate('PAGE_TITLE') . ' *', ['class' => 'label']) !!}
            {!! Form::text('title', null, ['class' => 'text-field']) !!}

            <div class="flex">
                <label class="label flex-1">{{_translate('CONTENT')}}</label>
                <div class="flex-1 text-right">
                    <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{_translate('IMAGES_FOR_POST')}}</a>
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
            {!! Form::text('slug', null, ['class' => 'text-field', 'placeholder' => _translate('EXAMPLE_URL_PLACEHOLDER')]) !!}

            <div class="my-4">
                {!! Form::hidden('published', "0") !!}

                {!! Form::checkbox('published', "1", false) !!}

                {!! Form::label('published', _translate('PAGE_IS_PUBLISHED')) !!}
            </div>

            <div class="my-4">
                {!! Form::hidden('in_menu', "0") !!}

                {!! Form::checkbox('in_menu', "1", false, ['onchange' => 'triggerMenuNameField(this)']) !!}

                {!! Form::label('in_menu', _translate('PAGE_IS_IN_MENU')) !!}

                <div id="menu_name" style="display: none;">
                    {!! Form::label('menu_name', _translate('MENU_NAME'), ['class' => 'label']) !!}
                    {!! Form::text('menu_name', null, ['class' => 'text-field', 'placeholder' => _translate('MENU_NAME')]) !!}
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

                {!! Form::label('is_homepage', _translate('PAGE_IS_HOMEPAGE')) !!}
            </div>

            * = {{_translate('REQUIRED')}}

            <div class="text-left">
                {!! Form::submit(_translate('CREATE_PAGE'), ['class' => 'bg-green-600 text-white rounded p-4 my-4']) !!}
            </div>

        </section>

        <section class="w-1/3 bg-gray-200 p-4 rounded-lg mb-8">

            <label class="label">
                {{_translate("PAGE_TYPE")}}
            </label>

            <p>
                {{_translate('CURRENTLY_USING')}}: <strong>{{$file_type}}</strong>.
            </p>

            {{_translate('CHANGE_TO')}}:

            @if($file_type !== 'md')
                <a href="{{route(Route::currentRouteName(), ['file_type' => 'md'])}}" class="text-blue-800 underline">Markdown</a>
            @endif

            @if($file_type !== 'html')
                <a href="{{route(Route::currentRouteName(), ['file_type' => 'html'])}}" class="text-blue-800 underline">HTML</a>
            @endif

            {{--{!! Form::label('template_name', 'Page Template *', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('template_name', $template_name, ['class' => 'text-field']) !!}--}}

            {!! Form::label('description', _translate('SEO_DESCRIPTION') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('description', null, ['class' => 'text-field', 'rows' => 5]) !!}

            {!! Form::label('summary', _translate('SEO_SUMMARY') . ' *', ['class' => 'label']) !!}
            {!! Form::textarea('summary', null, ['class' => 'text-field', 'rows' => 3]) !!}

            {{--{!! Form::label('keywords', 'Keywords', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('keywords', null, ['class' => 'text-field']) !!}--}}

            {{--{!! Form::label('author', 'Author', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('author', null, ['class' => 'text-field']) !!}--}}

            {{--{!! Form::label('canonical', 'Canonical link (if this is content is posted elsewhere, submit that URL)', ['class' => 'label']) !!}--}}
            {{--{!! Form::text('canonical', null, ['class' => 'text-field']) !!}--}}

            <label for="category" class="label">{{_translate('PAGE_CATEGORY')}}</label>
            <select name="category" class="text-field">

                @include('flatfilecmsgui::taxonomy.nested-categories', ['taxonomies' => $categories, 'selected' => null])

            </select>

            <a href="{{route('taxonomy.index')}}" class="underline" target="_blank">{{_translate('MANAGE_TAXONOMY')}}</a>

            {!! Form::label('image', _translate('IMAGE_FOR_SOCIAL_MEDIA'), ['class' => 'label']) !!}
            {!! Form::text('image', null, ['class' => 'text-field']) !!}

            {!! Form::label('sidebar', _translate('SIDEBAR_BLOCKS'), ['class' => 'label']) !!}
            {!! Form::textarea('sidebar', null, ['class' => 'text-field', 'rows' => 5]) !!}

        </section>

    </div>

    {!! Form::close() !!}

@endsection()
