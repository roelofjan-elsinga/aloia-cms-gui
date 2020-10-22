@extends('aloiacmsgui::template')

@section('navigation')

@endsection

@section('content')
    <div class="container mx-auto section text-center pt-8">
        <h1 class="text-2xl mb-8">{{trans('aloiacmsgui::auth.login_title')}}</h1>

        @if (session()->has('errors'))
            <div class="bg-red-600 md:w-1/2 mx-auto text-white p-4 rounded mb-8">
                <strong>Whoops!</strong> There were some problems with your input.
            </div>
        @endif

        <form action="{{route('authenticate.login')}}" method="post" class="flex flex-col md:w-1/2 mx-auto" autocomplete="off">
            {!! csrf_field() !!}
            <label class="text-left mb-2 font-bold" for="username">User name</label>
            <input type="text" id="username" name="username" class="flex-1 p-4 border mb-4 rounded" placeholder="User name" autofocus required>

            <label class="text-left mb-2 font-bold" for="password">Password</label>
            <input type="password" id="password" name="password" class="flex-1 p-4 border mb-4 rounded" placeholder="Password" autofocus required>

            <button type="submit" class="flex-1 p-4 mt-4 bg-green-500 text-white rounded">Log in</button>
        </form>
    </div>
@endsection
