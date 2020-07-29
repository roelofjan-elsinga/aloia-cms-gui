<div class="flex mb-4 text-theme-darkest no-underline">
    <div class="w-1/4 md:w-32">
        @if(!empty($article->thumbnail()))
            <img src="{{asset($article->thumbnail())}}" alt="{{$article->title()}}" style="max-height: 75px;"/>
        @else
            <img src="https://via.placeholder.com/115x75?text=Featured%20image" alt="Placeholder featured image" style="max-height: 75px;"/>
        @endif
    </div>
    <div class="w-3/4 px-4">
        <h4 class="flex-1 font-bold">
            <a href="{{route('articles.edit', $article->filename())}}">{{$article->title()}}</a>
            <small class="inline-block text-blue-600">
                <a href="/articles/{{$article->filename()}}" target="_blank" class="underline">({{trans("aloiacmsgui::pages.view")}})</a>
            </small>
        </h4>

        <div>
            {{trans('aloiacmsgui::articles.post_date')}}: {{$article->getPostDate()->format('F jS, Y')}}
        </div>

        @if($article->isPublished())
            <p class="status green">{{trans('aloiacmsgui::articles.published')}}</p>
        @endif

        @if($article->isScheduled())
            <p class="status orange">{{trans('aloiacmsgui::articles.scheduled')}}</p>
        @endif

        @if(!$article->isPublished() && !$article->isScheduled())
            <p class="status">{{trans('aloiacmsgui::articles.draft')}}</p>
        @endif
    </div>
</div>