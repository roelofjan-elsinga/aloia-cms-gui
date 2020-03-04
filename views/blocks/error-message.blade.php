@if(count($errors))
    <div class="bg-red-600 text-white p-4 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif