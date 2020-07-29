<form action="{{route($route_name)}}" method="get" class="my-4 block">
    <label for="q" class="font-bold">Search for a resource</label>
    <div class="flex">
        <input type="text" value="{{request()->get('q')}}"
               class="border p-4 rounded w-full flex-1"
               name="q" placeholder="Search for a resource"
               autocomplete="off" />
        <button type="submit" class="bg-blue-100 px-2">
            Search
        </button>
    </div>

    @if(request()->get('q'))
        <a href="{{route($route_name)}}" class="text-sm underline mt-2">Clear search request</a>
    @endif
</form>