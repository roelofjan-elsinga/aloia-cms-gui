@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::articles.edit', ['title' => $page_resource->title()])}}</h1>

    @include("aloiacmsgui::blocks.error-message")

    <form action="{{route('pages.update', $page_resource->filename())}}" method="post">

        @method('put')
        {!! csrf_field() !!}

        <div class="flex">
            <section class="w-2/3 pr-4">

                <input type="hidden" name="post_date" value="" />
                <input type="hidden" name="file_type" value="{{$file_type}}" />
                <input type="hidden" name="original_url" value="{{$page_resource->url()}}" />
                <input type="hidden" name="template_name" value="{{$page_resource->templateName()}}" />
                <input type="hidden" name="meta_data" value="{{!is_null($page_resource->metaData()) ? json_encode($page_resource->metaData()) : null}}" />

                <label for="title" class="label">{{trans('aloiacmsgui::pages.title')}} *</label>
                <input type="text" name="title" id="title" class="text-field" value="{{$page_resource->title()}}"
                       placeholder="{{trans('aloiacmsgui::pages.title')}}" />

                <div class="flex">
                    <label class="label flex-1">{{trans('aloiacmsgui::articles.content')}}</label>
                </div>

                <div class="mb-4">
                    @if($file_type === 'html')
                        @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $page_resource->rawBody()])
                    @else
                        @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => $page_resource->rawBody()])
                    @endif
                </div>

                <label for="url" class="label">URL *</label>
                <input type="text" name="url" id="url" class="text-field" value="{{$page_resource->url()}}"
                       placeholder="{{trans('aloiacmsgui::articles.example_url')}}" />

                <div class="my-4">
                    <input type="hidden" name="is_published" value="0">
                    <input type="checkbox" id="is_published" name="is_published"
                           value="1" {{$page_resource->isPublished() ? 'checked' : ''}}>
                    <label for="is_published">{{trans('aloiacmsgui::pages.is_published') }}</label>
                </div>

                <div class="my-4">
                    <input type="hidden" name="in_menu" value="0">
                    <input type="checkbox" id="in_menu" name="in_menu" value="1"
                           onchange="triggerMenuNameField(this)" {{$page_resource->isInMenu() ? 'checked' : ''}}>
                    <label for="in_menu">{{trans('aloiacmsgui::pages.in_menu') }}</label>

                    <div id="menu_name" style="display: none;">
                        <label for="menu_name" class="label">{{trans('aloiacmsgui::interface.menu_name')}}</label>
                        <input type="text" name="menu_name" id="menu_name" class="text-field" value="{{$page_resource->menuName()}}"
                               placeholder="{{trans('aloiacmsgui::interface.menu_name')}}" />
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
                    <input type="checkbox" id="is_homepage" name="is_homepage" value="1" {{$page_resource->isHomepage() ? 'checked' : ''}}>
                    <label for="is_published">{{trans('aloiacmsgui::pages.is_homepage') }}</label>
                </div>

                * = {{trans('aloiacmsgui::pages.required')}}

                <div class="text-left">
                    <button type="submit" class="bg-green-600 text-white rounded p-4 my-4">
                        {{trans('aloiacmsgui::pages.update')}}
                    </button>
                </div>

            </section>

            <section class="w-1/3 bg-gray-200 p-4 rounded-lg mb-8">

                <label class="label" for="description">{{trans('aloiacmsgui::pages.seo_description') }} *</label>
                <textarea name="description" id="description" class="text-field" rows="5" required
                          placeholder="{{trans('aloiacmsgui::pages.seo_description') }}">{{$page_resource->description()}}</textarea>

                <label class="label" for="summary">{{trans('aloiacmsgui::pages.seo_summary') }} *</label>
                <textarea name="summary" id="summary" class="text-field" rows="3" required
                          placeholder="{{trans('aloiacmsgui::pages.seo_summary') }}">{{$page_resource->summary()}}</textarea>

                <label for="canonical" class="label">{{trans('aloiacmsgui::pages.canonical_link')}}</label>
                <input type="text" name="canonical" id="canonical" class="text-field"
                       value="{{$page_resource->canonicalLink()}}" placeholder="https://google.com" />

                <label for="image" class="label">{{trans('aloiacmsgui::pages.social_media_image')}}</label>
                <input type="text" name="image" id="image" class="text-field"
                       value="{{$page_resource->image()}}" placeholder="https://google.com/image.jpeg" />

                <label class="label" for="sidebar">{{trans('aloiacmsgui::pages.sidebar_blocks') }}</label>
                <textarea name="sidebar" id="sidebar" class="text-field" rows="5"
                          placeholder="{{trans('aloiacmsgui::pages.sidebar_blocks') }}">{{$page_resource->metaData()['sidebar'] ?? ""}}</textarea>
            </section>

        </div>

    </form>

    <div class="">
        <form action="{{route('pages.destroy', $page_resource->url())}}" method="post">
            @method('delete')
            {!! csrf_field() !!}
            <button type="submit" class="link text-red-500" onclick="return confirm('Are you sure you want to delete this item?');">Delete this page</button>
        </form>
    </div>

@endsection
