@foreach($taxonomy as $category)

    <div class="bg-gray-{{$current_index * 100 + 100}} p-2 mb-4 rounded">

        <div class="flex">

            <div class="flex-1">
                <p>
                    <strong>{{_translate('CATEGORY_NAME')}}: "{{$category['category_name']}}"</strong>
                </p>

                <p>{{_translate('CATEGORY_URL_PREFIX')}}: {{$category['category_url_prefix']}}</p>
            </div>

            <div>
                <form action="{{route('taxonomy.destroy', $category['category_name'])}}" onsubmit="return confirm('Are you sure?')" method="POST">

                    <input type="hidden" name="_method" value="DELETE" />

                    {{ csrf_field() }}

                    <button type="submit" class="border border-red-600 text-red-600 hover:border-red-800 hover:text-red-800 rounded p-2 bg-white">
                        {{_translate_dynamic('DELETE_ITEM', $category['category_name'])}}
                    </button>

                </form>
            </div>

        </div>

        <form action="{{route('taxonomy.update', $category['category_url_prefix'])}}" method="POST">

            <input type="hidden" name="_method" value="PUT" />

            {{ csrf_field() }}

            <input type="hidden" name="parent_category" value="{{$category['category_url_prefix']}}" />

            <div>
                <input type="text" name="category_name"
                       placeholder="{{_translate('CATEGORY_NAME')}}"
                       value="{{$category['category_name']}}"
                       class="border border-gray-400 rounded p-2" />

                <input type="text" name="category_url_prefix"
                       placeholder="{{_translate('CATEGORY_URL_PREFIX')}}"
                       value="{{$category['category_url_prefix']}}"
                       class="border border-gray-400 rounded p-2" />
                <button type="submit" class="border border-blue-600 text-blue-600 hover:border-blue-800 hover:text-blue-800 rounded p-2 my-4 bg-white">
                    {{_translate('UPDATE_CATEGORY')}}
                </button>
            </div>

        </form>

        <div class="ml-2 mt-4">

            @if(count($category['children']) > 0)
            <h3>{{_translate('SUB_CATEGORIES')}}</h3>
            @endif

            @include('flatfilecmsgui::taxonomy.taxonomy', ['taxonomy' => $category['children'], 'current_index' => $current_index + 1])

            <form action="{{route('taxonomy.store')}}" method="POST">

                <h4>{{_translate_dynamic('ADD_SUB_CATEGORY_TO', $category['category_name'])}}</h4>

                {{ csrf_field() }}

                <input type="hidden" name="parent_category" value="{{$category['category_name']}}" />

                <div>
                    <input type="text" name="category_name" placeholder="{{_translate('CATEGORY_NAME')}}" class="border border-gray-400 rounded p-2" />
                    <input type="text" name="category_url_prefix" placeholder="{{_translate('CATEGORY_URL_PREFIX')}}" class="border border-gray-400 rounded p-2" />
                    <button type="submit" class="border border-green-600 text-green-600 hover:border-green-800 hover:text-green-800 rounded p-2 my-4 bg-white">
                        {{_translate('ADD_CATEGORY')}}
                    </button>
                </div>

            </form>
        </div>

    </div>


@endforeach