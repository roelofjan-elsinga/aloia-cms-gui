@extends('aloiacmsgui::template')

@section('content')

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

@endsection