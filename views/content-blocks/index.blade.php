@extends('aloiacmsgui::template')

@section('content')

    <h1 class="font-semibold text-2xl mb-4">{{trans('aloiacmsgui::content_blocks.blocks')}}</h1>

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            @if(session()->has('error'))
                <div class="bg-red-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.oops')}}!</strong>
                    @if(session()->get('error') === 'not_found')
                        {{trans('aloiacmsgui::content_blocks.not_found')}}
                    @endif
                </div>
            @endif

            @if(session()->has('success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong>
                    @if(session()->get('success') === 'deleted')
                        {{trans('aloiacmsgui::content_blocks.deleted')}}
                    @elseif(session()->get('success') === 'created')
                        {{trans('aloiacmsgui::content_blocks.created')}}
                    @endif
                </div>
            @endif

            <a href="{{route('content-blocks.create')}}" class="block underline mb-2">{{trans('aloiacmsgui::content_blocks.create_new')}}</a>

            <div>
                @foreach($blocks as $block)

                    <div class="mb-2 pb-2 border-b border-gray-300">
                        <h4>{{$block['name']}} ({{$block['extension']}})</h4>
                        <a href="{{route('content-blocks.edit', $block['name'])}}" class="inline-block underline">{{trans('aloiacmsgui::interface.edit')}}</a>
                        <form action="{{route('content-blocks.destroy', $block['name'])}}" onsubmit="return confirm('Are you sure?')" method="post" class="inline-block">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE" />

                            <button type="submit" class="block underline">{{trans('aloiacmsgui::interface.delete')}}</button>
                        </form>

                    </div>

                @endforeach
            </div>

        </section>

        <section class="md:w-1/4">

            @include('aloiacmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection
