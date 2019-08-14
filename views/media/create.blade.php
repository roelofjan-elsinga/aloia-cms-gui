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

    <h1 class="mb-4">{{_translate('UPLOAD_IMAGE')}}</h1>

    <form action="{{route('media.store')}}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{csrf_token()}}" />

        <div>
            <label for="image" class="label">{{_translate('UPLOAD_AN_IMAGE')}}</label>
            <input type="file" name="image" />
        </div>

        <div>
            <label for="name" class="label">{{_translate('WHAT_IS_NAME_OF_IMAGE')}}</label>
            <input type="text" name="name" class="text-field" placeholder="{{_translate('IMAGE_NAME')}}" minlength="4" />
        </div>

        <div class="mt-2">
            <input type="hidden" name="including_thumbnail" value="0" />
            <input type="checkbox" name="including_thumbnail" value="1" />
            <label type="hidden" for="including_thumbnail">{{_translate('IMAGE_NEEDS_THUMBNAIL')}}</label>
        </div>

        <button class="bg-green-600 text-white rounded p-4 my-4" type="submit">
            {{_translate('UPLOAD_IMAGE')}}
        </button>

    </form>

@endsection
