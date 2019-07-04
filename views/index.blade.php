@extends('flatfilecmsgui::template')

@section('content')

    <h1 class="mb-8">Welcome {{user()->username()}}!</h1>

    <main class="flex">

        <section class="flex-1 mr-4">



        </section>

        <section class="w-1/4">

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection