@extends('aloiacmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            <h1 class="mb-4">
                {{trans('aloiacmsgui::files.manage')}}
            </h1>

            <a href="{{route('files.create')}}"
               class="text-blue-800 mb-2 block underline">
                {{trans('aloiacmsgui::files.upload_new')}}
            </a>

            @if(Session::has('upload_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::files.uploaded')}}
                </div>
            @endif

            @if(Session::has('delete_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{trans('aloiacmsgui::interface.great')}}!</strong> {{trans('aloiacmsgui::files.deleted')}}
                </div>
            @endif

            @foreach($files as $file)

                <div class="bg-blue-100 p-2 rounded mb-2">

                    <div class="flex">
                        <div class="flex-1 font-bold text-blue-900 inline-block break-words">
                            {{$file->basename()}}
                        </div>

                        <form action="{{route('files.destroy', $file->basename())}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <button type="submit" class="bg-red-600 p-2 text-white rounded font-bold">

                                Delete

                            </button>
                        </form>
                    </div>

                    <div class="text-sm text-blue-800 break-words">
                        <strong>{{trans('aloiacmsgui::interface.link')}}:</strong> {{url('files/' . $file->basename())}}
                    </div>

                </div>

            @endforeach

        </section>

        <section class="md:w-1/4">

            @include('aloiacmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection