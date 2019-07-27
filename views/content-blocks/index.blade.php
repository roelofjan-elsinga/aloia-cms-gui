@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="font-semibold text-2xl mb-4">Content blocks</h1>

    <main class="flex">

        <section class="flex-1 mr-4">

            @if(session()->has('error'))
                <div class="bg-red-600 text-white p-4 rounded mb-4">
                    <strong>Oops!</strong>
                    @if(session()->get('error') === 'not_found')
                        I couldn't find that block!
                    @endif
                </div>
            @endif

            @if(session()->has('success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>Success!</strong>
                    @if(session()->get('success') === 'deleted')
                        The block was deleted successfully!
                    @elseif(session()->get('success') === 'created')
                        The block was created successfully!
                    @endif
                </div>
            @endif

            <a href="{{route('content-blocks.create')}}" class="block underline mb-2">Create new block</a>

            <div>
                @foreach($blocks as $block)

                    <div class="mb-2 pb-2 border-b border-gray-300">
                        <h4>{{$block['name']}} ({{$block['extension']}})</h4>
                        <a href="{{route('content-blocks.edit', $block['name'])}}" class="inline-block underline">Edit</a>
                        <form action="{{route('content-blocks.destroy', $block['name'])}}" onsubmit="confirm('Are you sure?')" method="post" class="inline-block">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="DELETE" />

                            <button type="submit" class="block underline">Delete</button>
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
