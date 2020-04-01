@foreach($taxonomy as $category)

    <div class="bg-gray-{{$current_index * 100 + 100}} p-2 mb-4 rounded">

        <div class="flex">

            <div class="flex-1">
                <p>
                    <strong>{{trans('aloiacmsgui::interface.taxonomy.name')}}: "{{$category->name()}}"</strong>
                </p>

                <p>{{trans('aloiacmsgui::interface.taxonomy.url_prefix')}}: {{$category->url()}}</p>
            </div>

            <div>
                <form action="{{route('taxonomy.destroy', $category->name())}}" onsubmit="return confirm('Are you sure?')" method="POST">

                    <input type="hidden" name="_method" value="DELETE" />

                    {{ csrf_field() }}

                    <button type="submit" class="border border-red-600 text-red-600 hover:border-red-800 hover:text-red-800 rounded p-2 bg-white">
                        {{trans('aloiacmsgui::interface.delete_item', ['title' => $category->name()])}}
                    </button>

                </form>
            </div>

        </div>

        <form action="{{route('taxonomy.update', $category->url())}}" method="POST">

            <input type="hidden" name="_method" value="PUT" />

            {{ csrf_field() }}

            <input type="hidden" name="parent_category" value="{{$category->url()}}" />

            <div>
                <input type="text" name="category_name"
                       placeholder="{{trans('aloiacmsgui::interface.taxonomy.name')}}"
                       value="{{$category->name()}}"
                       class="border border-gray-400 rounded p-2" />

                <input type="text" name="category_url_prefix"
                       placeholder="{{trans('aloiacmsgui::interface.taxonomy.url_prefix')}}"
                       value="{{$category->url()}}"
                       class="border border-gray-400 rounded p-2" />
                <button type="submit" class="border border-blue-600 text-blue-600 hover:border-blue-800 hover:text-blue-800 rounded p-2 my-4 bg-white">
                    {{trans('aloiacmsgui::interface.taxonomy.update')}}
                </button>
            </div>

        </form>

        <div class="ml-2 mt-4">

            @if($category->children()->count() > 0)
            <h3>{{trans('aloiacmsgui::interface.taxonomy.children')}}</h3>
            @endif

            @include('aloiacmsgui::taxonomy.taxonomy', ['taxonomy' => $category->children(), 'current_index' => $current_index + 1])

            <form action="{{route('taxonomy.store')}}" method="POST">

                <h4>{{trans('aloiacmsgui::interface.taxonomy.add_to', ['title' => $category->name()])}}</h4>

                {{ csrf_field() }}

                <input type="hidden" name="parent_category" value="{{$category->name()}}" />

                <div>
                    <input type="text" name="category_name" placeholder="{{trans('aloiacmsgui::interface.taxonomy.name')}}" class="border border-gray-400 rounded p-2" />
                    <input type="text" name="category_url_prefix" placeholder="{{trans('aloiacmsgui::interface.taxonomy.url_prefix')}}" class="border border-gray-400 rounded p-2" />
                    <button type="submit" class="border border-green-600 text-green-600 hover:border-green-800 hover:text-green-800 rounded p-2 my-4 bg-white">
                        {{trans('aloiacmsgui::interface.taxonomy.add')}}
                    </button>
                </div>

            </form>
        </div>

    </div>


@endforeach