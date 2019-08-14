@extends('flatfilecmsgui::template')

@section('content')

    @if(session()->has('errors'))
        <div class="bg-red-600 text-white p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="mb-4">{{_translate('UPLOAD_FILE')}}</h1>

    <form action="{{route('files.store')}}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{csrf_token()}}" />

        <div>
            <label for="file" class="label">{{_translate('UPLOAD_A_NEW_FILE')}}</label>
            <input type="file" name="file" />
        </div>

        <button class="bg-green-600 text-white rounded p-4 my-4" type="submit">
            {{_translate('UPLOAD_FILE')}}
        </button>

    </form>

@endsection
