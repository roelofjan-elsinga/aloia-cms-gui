@extends('flatfilecmsgui::template')

@section('content')
    <div class="section text-center">
        @if (session()->has('errors'))
            <div class="bg-red-600 md:w-1/2 mx-auto text-white p-4 rounded mb-8">
                <strong>Whoops!</strong> There were some problems with your input.
            </div>
        @endif

        {!! Form::open(['route' => 'authenticate.login', 'method' => 'post', 'class' => 'flex flex-col md:w-1/2 mx-auto', 'autocomplete' => false]) !!}

            {!! Form::label('username', 'User name', ['class' => 'text-left mb-2 font-bold']) !!}
            {!! Form::text('username', null, ['class' => 'flex-1 p-4 border mb-4 rounded', 'placeholder' => 'User name', 'autofocus', 'required' => 'required']) !!}

            {!! Form::label('password', 'Password', ['class' => 'text-left mb-2 font-bold']) !!}
            {!! Form::input('password', 'password', null, ['class' => 'flex-1 p-4 border mb-4 rounded', 'placeholder' => 'Password', 'required' => 'required']) !!}

            {!! Form::submit('Log in', ['class' => 'flex-1 p-4 mt-4 bg-green-500 text-white rounded']) !!}

        {!! Form::close() !!}
    </div>
@endsection
