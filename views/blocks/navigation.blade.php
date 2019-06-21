<nav class="menu block w-full" id="home">
    <div class="flex h-16 md:h-32">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="block flex-1 flex items-center text-blue-darkest no-underline text-2xl font-bold"
           href="{{ route('dashboard') }}">
            <span class="hidden md:block">{{config('app.name')}}</span>
            <span class="block md:hidden max-h-">
                <img src="{{asset('images/icons/android-chrome-144x144.png')}}" class="h-12">
            </span>
        </a>

        <ul class="block flex-1 flex items-center justify-end">
            <li class="inline-block mx-2"><a class="link" href="{{route('home')}}">View website</a></li>
        </ul>
    </div><!-- /.container-fluid -->
</nav>
