@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::articles.create')}}</h1>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-8">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>Warning!</strong> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('articles.store')}}" method="post">
        {!! csrf_field() !!}

        <input type="hidden" name="file_type" value="{{$file_type}}">

        <label class="label" for="slug">URL *</label>
        <input type="text" name="slug" class="text-field" placeholder="{{trans('aloiacmsgui::articles.example_url')}}" required>

        <div class="flex">
            <label class="label">{{trans('aloiacmsgui::articles.content')}} *</label>
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

        <label class="label" for="description">{{trans('aloiacmsgui::articles.description') }} *</label>
        <textarea name="description" class="text-field" rows="5" required
                  placeholder="{{trans('aloiacmsgui::articles.description') }}"></textarea>

        <label class="label" for="post_date">{{trans('aloiacmsgui::articles.post_date') }}</label>
        <input type="date" name="post_date" class="text-field">

        <input type="hidden" name="faq" id="faqField" value="{{json_encode([])}}"/>
        <div id="faqEditor" data-faq="{{json_encode([])}}" data-form-field="faqField"></div>

        @include('aloiacmsgui::articles.custom_content')

        <div class="my-4">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" id="is_published" name="is_published" value="1">
            <label for="is_published">{{trans('aloiacmsgui::articles.is_published') }}</label>
        </div>

        <div class="my-4">
            <input type="hidden" name="is_scheduled" value="0">
            <input type="checkbox" id="is_scheduled" name="is_scheduled" value="1">
            <label for="is_scheduled">{{trans('aloiacmsgui::articles.is_scheduled') }}</label>
        </div>

        * = {{trans('aloiacmsgui::pages.required')}}

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white rounded p-4 my-4">
                {{trans('aloiacmsgui::articles.create')}}
            </button>
        </div>

    </form>

@endsection

@push('scripts')
    <script src="{{asset(mix('FAQEditor.js', 'vendor/aloiacmsgui'))}}" defer></script>
@endpush
