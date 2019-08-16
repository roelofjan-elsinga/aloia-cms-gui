@extends('flatfilecmsgui::template')

@section('content')

    <main class="flex flex-col md:flex-row">

        <section class="flex-1 mr-4">

            <h1 class="mb-4">
                {{_translate('MANAGE_UPLOADED_FILES')}}
            </h1>

            <a href="{{route('files.create')}}"
               class="text-blue-800 mb-2 block underline">
                {{_translate('UPLOAD_A_NEW_FILE')}}
            </a>

            @if(Session::has('upload_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('FILE_UPLOADED')}}
                </div>
            @endif

            @if(Session::has('delete_success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    <strong>{{_translate('GREAT')}}!</strong> {{_translate('FILE_DELETED')}}
                </div>
            @endif

            @foreach($files as $file)

                <div class="flex bg-blue-100 p-2 rounded mb-2">

                    <span class="flex-1 font-bold text-blue-900">
                        {{$file->basename()}}
                    </span>

                    <form action="{{route('files.destroy', $file->basename())}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <button type="submit" class="bg-red-600 p-2 text-white rounded font-bold">

                            Delete

                        </button>
                    </form>

                </div>

            @endforeach

        </section>

        <section class="md:w-1/4">

            @include('flatfilecmsgui::blocks.actions-sidebar')

        </section>

    </main>

@endsection