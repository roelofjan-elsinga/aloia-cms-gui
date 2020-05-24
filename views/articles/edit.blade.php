@extends('aloiacmsgui::template')

@section('content')

    <h1 class="mb-8 text-xl font-semibold">{{trans('aloiacmsgui::articles.edit', ['title' => $article->title()])}}</h1>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded mb-8">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>Warning!</strong> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('articles.update', $article->slug())}}" method="post">
        @method('put')
        {!! csrf_field() !!}

        <input type="hidden" name="file_type" value="{{$article->extension()}}">
        <input type="hidden" name="original_slug" value="{{$article->slug()}}">

        <label class="label" for="slug">URL *</label>
        <input type="text" name="slug" class="text-field" value="{{$article->slug()}}"
               placeholder="{{trans('aloiacmsgui::articles.example_url')}}" required>

        <div class="flex">
            <label class="label flex-1">{{trans('aloiacmsgui::articles.content')}} *</label>
            <div class="flex-1 text-right">
                <a href="{{route('media.index')}}" target="_blank" class="mb-2 mt-4 inline-block link-no-underline">{{trans('aloiacmsgui::images.for_post')}}</a>
            </div>
        </div>

        <div class="mb-4">
            @if($file_type === 'html')
                @include('aloiacmsgui::blocks.ckeditor', ['name' => 'content', 'value' => $article->rawBody()])
            @else
                @include('aloiacmsgui::blocks.simplemde', ['name' => 'content', 'value' => $article->rawBody()])
            @endif
        </div>

        <label class="label" for="description">{{trans('aloiacmsgui::articles.description') }} *</label>
        <textarea name="description" class="text-field" rows="5" required
                  placeholder="{{trans('aloiacmsgui::articles.description') }}">{{$article->description()}}</textarea>

        <input type="hidden" name="faq" id="faqField"/>
        <div id="faqEditor" data-faq="{{json_encode($article->faq ?? [])}}" data-form-field="faqField"></div>

        <label class="label" for="post_date">{{trans('aloiacmsgui::articles.post_date') }}</label>
        <input type="date" name="post_date" class="text-field" value="{{$article->getPostDate()->toDateString()}}">

        <div class="my-4">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" value="1" {{$article->isPublished() ? 'checked' : ''}}>
            <label for="is_published">{{trans('aloiacmsgui::articles.is_published') }}</label>
        </div>

        <div class="my-4">
            <input type="hidden" name="is_scheduled" value="0">
            <input type="checkbox" name="is_scheduled" value="1" {{$article->isScheduled() ? 'checked' : ''}}>
            <label for="is_scheduled">{{trans('aloiacmsgui::articles.is_scheduled') }}</label>
        </div>

        * = {{trans('aloiacmsgui::pages.required')}}

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white rounded p-4 my-4">
                {{trans('aloiacmsgui::articles.update')}}
            </button>
        </div>

    </form>

    <div class="">
        <form action="{{route('articles.destroy', $article->slug())}}" method="post">
            @method('delete')
            {!! csrf_field() !!}
            <button type="submit" class="link text-red-500" onclick="return confirm('Are you sure you want to delete this item?');">Delete this article</button>
        </form>
    </div>

@endsection

@push('scripts')
    <script src="{{asset(mix('FAQEditor.js', 'vendor/aloiacmsgui'))}}" defer></script>
@endpush