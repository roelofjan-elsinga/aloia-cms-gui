@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            <h1 class="mb-4">
                {{_translate("MANAGE_TAXONOMY")}}
            </h1>

            @if(session()->has('created') || session()->has('updated'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('TAXONOMY_SAVED')}}
                </div>
            @endif

            @if(session()->has('deleted'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('TAXONOMY_DELETED')}}
                </div>
            @endif

            @include('flatfilecmsgui::taxonomy.taxonomy', ['taxonomy' => $taxonomy, 'current_index' => 0])

        </section>

        <section class="md:w-1/4">

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection