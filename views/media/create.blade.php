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

    {!! Form::open(['route' => 'media.store', 'method' => 'post', 'files' => true]) !!}

    <div>
        {!! Form::label('image', _translate('UPLOAD_AN_IMAGE'), ['class' => 'label']) !!}
        {!! Form::file('image') !!}
    </div>

    <div>
        {!! Form::label('name', _translate('WHAT_IS_NAME_OF_IMAGE'), ['class' => 'label']) !!}
        {!! Form::text('name', null, ['class' => 'text-field', 'placeholder' => _translate('IMAGE_NAME'), 'minlength' => 4]) !!}
    </div>

    <div class="mt-2">
        {!! Form::hidden('including_thumbnail', "0") !!}
        {!! Form::checkbox('including_thumbnail', "1", false) !!}
        {!! Form::label('including_thumbnail', _translate('IMAGE_NEEDS_THUMBNAIL')) !!}
    </div>

    {!! Form::submit(_translate('UPLOAD_IMAGE'), ['class' => 'bg-green-dark text-white rounded p-4 my-4']) !!}

    {!! Form::close() !!}

@endsection
