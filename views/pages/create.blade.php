@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::pages.create_new')}}</h1>

    @include("aloiacmsgui::blocks.error-message")

    <form action="{{route('pages.store')}}" method="post">

        {!! csrf_field() !!}

        <div class="flex">

            <section class="w-2/3 pr-4">

                <input type="hidden" name="post_date" value="{{ Carbon\Carbon::Now()->toDateTimeString() }}" />
                <input type="hidden" name="file_type" value="{{$file_type}}" />
                <input type="hidden" name="template_name" value="{{$template_name}}" />

                <label for="title" class="label">{{trans('aloiacmsgui::pages.title')}} *</label>
                <input type="text" name="title" id="title" class="text-field" placeholder="{{trans('aloiacmsgui::pages.title')}}" />

                <div class="flex">
                    <label class="label flex-1">{{trans('aloiacmsgui::articles.content')}}</label>
                </div>

                <div class="mb-4">
                    @if($file_type === 'html')
                        @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => null])
                    @else
                        @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => null])
                    @endif
                </div>

                <label for="url" class="label">URL *</label>
                <input type="text" name="url" id="url" class="text-field" placeholder="{{trans('aloiacmsgui::articles.example_url')}}" />

                <div class="my-4">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" id="is_published" name="is_published" value="1">
                    <label for="is_published">{{trans('aloiacmsgui::pages.is_published') }}</label>
                </div>

                <div class="my-4">
                    <input type="hidden" name="in_menu" value="0">
                    <input type="checkbox" id="in_menu" name="in_menu" value="1" onchange="triggerMenuNameField(this)">
                    <label for="in_menu">{{trans('aloiacmsgui::pages.in_menu') }}</label>

                    <div id="menu_name" style="display: none;">
                        <label for="menu_name" class="label">{{trans('aloiacmsgui::interface.menu_name')}}</label>
                        <input type="text" name="menu_name" id="menu_name" class="text-field" placeholder="{{trans('aloiacmsgui::interface.menu_name')}}" />
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
                    <input type="hidden" name="is_homepage" value="0">
                    <input type="checkbox" id="is_homepage" name="is_homepage" value="1">
                    <label for="is_published">{{trans('aloiacmsgui::pages.is_homepage') }}</label>
                </div>

                * = {{trans('aloiacmsgui::pages.required')}}

                <div class="text-left">
                    <button type="submit" class="bg-green-600 text-white rounded p-4 my-4">
                        {{trans('aloiacmsgui::pages.create')}}
                    </button>
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

                <label class="label" for="description">{{trans('aloiacmsgui::pages.seo_description') }} *</label>
                <textarea name="description" id="description" class="text-field" rows="5" required
                          placeholder="{{trans('aloiacmsgui::pages.seo_description') }}"></textarea>

                <label class="label" for="summary">{{trans('aloiacmsgui::pages.seo_summary') }} *</label>
                <textarea name="summary" id="summary" class="text-field" rows="3" required
                          placeholder="{{trans('aloiacmsgui::pages.seo_summary') }}"></textarea>

                <label for="canonical" class="label">{{trans('aloiacmsgui::pages.canonical_link')}}</label>
                <input type="text" name="canonical" id="canonical" class="text-field" placeholder="https://google.com" />

                <label for="image" class="label">{{trans('aloiacmsgui::pages.social_media_image')}}</label>
                <input type="text" name="image" id="image" class="text-field" placeholder="https://google.com/image.jpeg" />

                <label class="label" for="sidebar">{{trans('aloiacmsgui::pages.sidebar_blocks') }}</label>
                <textarea name="sidebar" id="sidebar" class="text-field" rows="5"
                          placeholder="{{trans('aloiacmsgui::pages.sidebar_blocks') }}"></textarea>

            </section>

        </div>

    </form>

@endsection()
