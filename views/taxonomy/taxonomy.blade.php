@foreach($taxonomy as $category)

    <div class="bg-gray-{{$current_index * 100 + 100}} p-2 mb-4">

        <p>
            <strong>{{_translate('CATEGORY_NAME')}}: "{{$category['category_name']}}"</strong>
        </p>

        <p>{{_translate('CATEGORY_URL_PREFIX')}}: {{$category['category_url_prefix']}}</p>

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
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white rounded p-2 my-4">
                    {{_translate('UPDATE_CATEGORY')}}
                </button>
            </div>

        </form>

        <div class="ml-2 mt-4">

            <h3>{{_translate('SUB_CATEGORIES')}}</h3>

            @include('flatfilecmsgui::taxonomy.taxonomy', ['taxonomy' => $category['children'], 'current_index' => $current_index + 1])

            <form action="{{route('taxonomy.store')}}" method="POST">

                <h4>{{_translate_dynamic('ADD_SUB_CATEGORY_TO', $category['category_name'])}}</h4>

                {{ csrf_field() }}

                <input type="hidden" name="parent_category" value="{{$category['category_name']}}" />

                <div>
                    <input type="text" name="category_name" placeholder="{{_translate('CATEGORY_NAME')}}" class="border border-gray-400 rounded p-2" />
                    <input type="text" name="category_url_prefix" placeholder="{{_translate('CATEGORY_URL_PREFIX')}}" class="border border-gray-400 rounded p-2" />
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white rounded p-2 my-4">
                        {{_translate('ADD_CATEGORY')}}
                    </button>
                </div>

            </form>
        </div>

    </div>


@endforeach