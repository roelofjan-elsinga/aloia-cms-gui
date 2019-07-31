@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="font-semibold text-2xl mb-4">{{_translate('CONTENT_BLOCKS')}}</h1>

    <main class="flex">

        <section class="flex-1 mr-4">

            @if(session()->has('error'))
                <div class="bg-red-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('OOPS')}}!</strong>
                    @if(session()->get('error') === 'not_found')
                        {{_translate('COULDNT_FIND_BLOCK')}}
                    @endif
                </div>
            @endif

            @if(session()->has('success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong>
                    @if(session()->get('success') === 'deleted')
                        {{_translate('BLOCK_DELETED')}}
                    @elseif(session()->get('success') === 'created')
                        {{_translate('BLOCK_CREATED')}}
                    @endif
                </div>
            @endif

            <a href="{{route('content-blocks.create')}}" class="block underline mb-2">{{_translate('CREATE_NEW_BLOCK')}}</a>

            <div>
                @foreach($blocks as $block)

                    <div class="mb-2 pb-2 border-b border-gray-300">
                        <h4>{{$block['name']}} ({{$block['extension']}})</h4>
                        <a href="{{route('content-blocks.edit', $block['name'])}}" class="inline-block underline">{{_translate('EDIT')}}</a>
                        <form action="{{route('content-blocks.destroy', $block['name'])}}" onsubmit="return confirm('Are you sure?')" method="post" class="inline-block">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE" />

                            <button type="submit" class="block underline">{{_translate('DELETE')}}</button>
                        </form>

                    </div>

                @endforeach
            </div>

        </section>

        <section>

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection
