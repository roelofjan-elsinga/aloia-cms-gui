@extends('aloiacmsgui::template')

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

    <h1 class="mb-4">{{trans('aloiacmsgui::images.upload')}}</h1>

    <form action="{{route('media.store')}}" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="_token" value="{{csrf_token()}}" />

        <div>
            <label for="image" class="label">{{trans('aloiacmsgui::images.upload_new')}}</label>
            <input type="file" name="image" />
        </div>

        <div>
            <label for="name" class="label">{{trans('aloiacmsgui::images.name_question')}}</label>
            <input type="text" name="name" class="text-field" placeholder="{{trans('aloiacmsgui::images.name')}}" minlength="4" />
        </div>

        <div class="mt-2">
            <input type="hidden" name="including_thumbnail" value="0" />
            <input type="checkbox" name="including_thumbnail" value="1" />
            <label type="hidden" for="including_thumbnail">{{trans('aloiacmsgui::images.need_thumbnail')}}</label>
        </div>

        <button class="bg-green-600 text-white rounded p-4 my-4" type="submit">
            {{trans('aloiacmsgui::images.upload')}}
        </button>

    </form>

@endsection
