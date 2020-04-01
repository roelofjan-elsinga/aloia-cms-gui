@extends('aloiacmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            <h1 class="mb-4">
                {{trans("aloiacmsgui::interface.taxonomy.manage")}}
            </h1>

            @if(session()->has('created') || session()->has('updated'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::interface.taxonomy.saved')}}
                </div>
            @endif

            @if(session()->has('deleted'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::interface.taxonomy.deleted')}}
                </div>
            @endif

            @include('aloiacmsgui::taxonomy.taxonomy', ['taxonomy' => $taxonomy, 'current_index' => 0])

        </section>

        <section class="md:w-1/4">

            @include('aloiacmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection